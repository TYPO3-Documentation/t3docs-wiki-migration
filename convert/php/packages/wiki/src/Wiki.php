<?php

declare(strict_types=1);

namespace Typo3\Wiki;

use Exception;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Wiki
{
    const LOGLEVEL_INFO = 1;
    const LOGLEVEL_WARNING = 2;

    protected string $wikiUrl;
    protected string $wikiApiUrl;
    protected bool $keepTemporaryFiles;
    protected array $includePages;
    protected int $logLevel;

    protected string $projectDir;
    protected string $outputDir;
    protected string $filesDir;
    protected string $filesUrl;
    protected array $pages;
    protected array $urlMap;
    protected array $urlMapOfFailed;

    public function __construct(string $outputDir)
    {
        $this->wikiUrl = 'https://wiki.typo3.org';
        $this->wikiApiUrl = 'https://wiki.typo3.org/api.php';
        $this->keepTemporaryFiles = false;
        $this->includePages = [];
        $this->logLevel = self::LOGLEVEL_INFO;

        $this->projectDir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
        $this->outputDir = $this->projectDir . DIRECTORY_SEPARATOR . $outputDir;
        $this->filesDir = $this->outputDir . DIRECTORY_SEPARATOR . 'files';
        $this->filesUrl = 'files';
        $this->pages = [];
        $this->urlMap = [];
        $this->urlMapOfFailed = [];
    }

    public function run(): void
    {
        $this->loadMapOfFailedUrls();
        $this->cleanDir($this->filesDir);
        $this->cleanDir($this->outputDir);
        $this->createDir($this->outputDir);
        $this->fetchListOfPages();
        $this->fetchPages();
        $this->reducePages();
        $this->replaceLinksOfPages();
        $this->fetchImagesOfPages();
        $this->convert();
        $this->postProcess();
        $this->saveMapOfFailedUrls();
        if (!$this->keepTemporaryFiles) {
            $this->cleanDir($this->outputDir, '/(\.html|-s5-converted\.rst)$/');
        }
    }

    protected function loadMapOfFailedUrls(): void
    {
        if (is_file($this->outputDir . DIRECTORY_SEPARATOR . '_map_of_failed_urls.php')) {
            $this->urlMapOfFailed = include $this->outputDir . DIRECTORY_SEPARATOR . '_map_of_failed_urls.php';
        }
    }

    protected function saveMapOfFailedUrls(): void
    {
        $urlMapOfFailed = array_filter($this->urlMap, function($responseUrl){
            return $responseUrl === '' || strpos($responseUrl, $this->wikiUrl) === 0;
        });
        $urlMapOfFailed = array_merge($urlMapOfFailed, $this->urlMapOfFailed);

        if (count($urlMapOfFailed)) {
            ksort($urlMapOfFailed);
            $content = sprintf("<?php\nreturn %s;", var_export($urlMapOfFailed, true));
            file_put_contents($this->outputDir . DIRECTORY_SEPARATOR . '_map_of_failed_urls.php', $content);
        }
    }

    /**
     * Create directory if not exists.
     *
     * @param string $folder
     */
    protected function createDir(string $folder): void
    {
        if (!is_dir($folder)) {
            mkdir($folder);
            $this->info("Folder %s created.", $folder);
        }
    }

    /**
     * Clean up all specified files in folder and remove folder if empty.
     *
     * @param string $folder
     * @param string $filePattern
     */
    protected function cleanDir(string $folder, string $filePattern = ''): void
    {
        if (is_dir($folder)) {
            if ($handle = opendir($folder)) {
                while (false !== ($file = readdir($handle))) {
                    $filePath = $folder . DIRECTORY_SEPARATOR . $file;
                    if (is_file($filePath)) {
                        $pathInfo = pathinfo($filePath);
                        if (empty($filePattern) || preg_match($filePattern, $pathInfo['basename'])) {
                            unlink($filePath);
                        }
                    }
                }
                closedir($handle);
            }
            @rmdir($folder);
        }
        $this->info("Folder %s cleaned up.", $folder);
    }

    /**
     * Fetch list of TYPO3 Wiki pages.
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws DecodingExceptionInterface
     *
     * @see https://www.mediawiki.org/wiki/API:Query
     * @see https://www.mediawiki.org/wiki/API:Info
     */
    protected function fetchListOfPages(): void
    {
        $client = HttpClient::create();
        $query = [
            'action' => 'query',
            'generator' => 'allpages',
            'prop' => 'info',
            'inprop' => 'url',
            'format' => 'json',
            'gaplimit' => 500,
        ];
        $pages = [];
        $includePagesIndex = array_flip($this->includePages);

        do {
            $response = $client->request('GET', $this->wikiApiUrl, ['query' => $query + [
                    'gapcontinue' => $responseData['continue']['gapcontinue'] ?? ''
                ]]);
            $responseData = $response->toArray();
            if (!empty($responseData['query']['pages'])) {
                $pages += $responseData['query']['pages'];
            }
        } while (!empty($responseData['continue']['gapcontinue']));

        foreach ($pages as &$page) {
            if (!empty($includePagesIndex)) {
                if (isset($includePagesIndex[$page['canonicalurl']])) {
                    $this->pages[] = $page['canonicalurl'];
                }
            } else {
                $this->pages[] = $page['canonicalurl'];
            }
        }

        $this->info("%d pages will be fetched.", count($this->pages));
    }

    /**
     * Crawl TYPO3 Wiki pages and save their content into folder $this->outputDir.
     */
    protected function fetchPages(): void
    {
        if (count($this->pages) > 0) {
            $client = HttpClient::create();
            $responses = [];
            foreach ($this->pages as $pageUrl) {
                $responses[$pageUrl] = $client->request('GET', $pageUrl);
            }
            foreach ($responses as $requestUrl => $response) {
                $content = $response->getContent(false);
                if ($response->getStatusCode() === 200) {
                    $localPageUrl = $this->savePageToLocal($requestUrl, $content, '-s1-full.html');
                    $pageName = str_replace('-s1-full.html', '', $localPageUrl);
                    $this->urlMap[$requestUrl] = $this->getPageId($pageName);
                    $this->info("Page %s fetched and saved to %s.", $requestUrl, $localPageUrl);
                } else {
                    $this->warn("Page %s not fetched (status code: %s)!", $requestUrl, $response->getStatusCode());
                }
            }
        }
    }

    /**
     * Save fetched page to local page folder and return path of local page.
     *
     * @param string $pageUrl Original page url
     * @param string $pageContent Original page content
     * @param string $suffix Local file suffix
     * @return string Local file path
     */
    protected function savePageToLocal(string $pageUrl, string $pageContent, string $suffix): string
    {
        $pathInfo = pathinfo(parse_url($pageUrl)['path']);
        $fileName = $this->getPageName($pathInfo['basename']);
        $fileNameAndExt = $fileName . $suffix;
        $index = 1;

        while (is_file($this->outputDir . DIRECTORY_SEPARATOR . $fileNameAndExt)) {
            $fileNameAndExt = $fileName . '-' . $index++ . $suffix;
        }
        file_put_contents($this->outputDir . DIRECTORY_SEPARATOR . $fileNameAndExt, $pageContent);

        return $fileNameAndExt;
    }

    /**
     * Get PageName from file name of page url.
     *
     * @param string $fileName
     * @return string Page name
     */
    protected function getPageName(string $fileName): string
    {
        return str_replace('_', '', ucwords(
            str_replace(['-', ' ', ',', ':', '.'], '_', strtolower($fileName)), '_')
        );
    }

    /**
     * Convert PageName into page-id.
     *
     * @param string $pageName
     * @return string Page ID
     */
    protected function getPageId(string $pageName): string
    {
        return ltrim(strtolower(preg_replace('|([A-Z]{1})|', '-$1', $pageName)), '-');
    }

    /**
     * Traverse folder and extract essential html from HTML files.
     */
    protected function reducePages(): void
    {
        if ($handle = opendir($this->outputDir)) {
            while (false !== ($file = readdir($handle))) {
                $filePath = $this->outputDir . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    $pathInfo = pathinfo($filePath);
                    if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s1-full') !== false) {
                        $pageName = str_replace('-s1-full', '', $pathInfo['filename']);
                        try {
                            $targetFileName = $pageName . '-s2-reduce';
                            $targetFilePath = $this->outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.html';
                            $this->reducePage($filePath, $targetFilePath, $pageName);
                            $this->info("Page %s reduced.", $pageName);
                        } catch (Exception $e) {
                            $this->warn("Page %s could not be reduced (%s)!", $pageName, $e->getMessage());
                        }
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * Extract essential html parts like title and content from TYPO3 Wiki page
     * and remove superfluous HTML attributes.
     *
     * @param string $sourceFile
     * @param string $targetFile
     * @param string $pageName
     */
    protected function reducePage(string $sourceFile, string $targetFile, string $pageName): void
    {
        $content = file_get_contents($sourceFile);
        $this->reduceContent($content, $pageName);
        file_put_contents($targetFile, $content);
    }

    protected function reduceContent(&$content, $pageName): void
    {
        $crawler = new Crawler($content);
        $title = $crawler->filterXPath('//h1[@id="firstHeading"]')->outerHtml();
        $bodyParts = $crawler->filterXPath('//div[@class="mw-parser-output"]/*[not(contains(@class, "toc"))]')
            ->each(function(Crawler $node){return $node->outerHtml();});
        $pageId = $this->getPageId($pageName);

        $body = implode("\n\n", $bodyParts);
        $this->streamlineHeadingsOfPageBody($body);

        $content = $title . "\n\n" . $body;
        $content = preg_replace('/id="[^"]*"/', '', $content);
        $content = preg_replace('/class="[^"]*"/', '', $content);
        $content = preg_replace('/width="[^"]*"/', '', $content);
        $content = preg_replace('/height="[^"]*"/', '', $content);
        $content = preg_replace('/<a[^>]*>\s*<\/a>/', '', $content);
        $content = preg_replace('/<p[^>]*>\s*<br>\s*<\/p>/', '', $content);

        $content = preg_replace_callback('/<(h1[^>]*)>(.*)<\/h1>/', function($matches) use($pageId) {
            return sprintf('<%s id="%s">%s</h1>', $matches[1], $pageId, $matches[2]);
        }, $content, 1);
    }

    /**
     * Remove any <h1> heading from the page body - as it should be used in the page title only.
     * Reduce gaps between headings, e.g. <h2><h4> should become <h2><h3>
     *
     * @param string $pageBody
     */
    protected function streamlineHeadingsOfPageBody(string &$pageBody): void
    {
        preg_match_all('|<h([1-5])|', $pageBody, $matches);

        if (count($matches) > 0) {
            $headerMap = array_flip($matches[1]);

            ksort($headerMap);
            for ($level=2, reset($headerMap); $level<count($headerMap)+2; $level++, next($headerMap)) {
                $headerMap[key($headerMap)] = $level;
            }

            foreach ($headerMap as $originalLevel => $actualLevel) {
                $pageBody = str_replace(
                    ['<h'.$originalLevel, 'h'.$originalLevel.'>'],
                    ['<intermediate'.$originalLevel, 'intermediate'.$originalLevel.'>'],
                    $pageBody
                );
            }
            foreach ($headerMap as $originalLevel => $actualLevel) {
                $pageBody = str_replace(
                    ['<intermediate'.$originalLevel, 'intermediate'.$originalLevel.'>'],
                    ['<h'.$actualLevel, 'h'.$actualLevel.'>'],
                    $pageBody
                );
            }
        }
    }

    /**
     * Traverse folder and replace links by actual links - if available.
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    protected function replaceLinksOfPages(): void
    {
        if ($handle = opendir($this->outputDir)) {
            while (false !== ($file = readdir($handle))) {
                $filePath = $this->outputDir . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    $pathInfo = pathinfo($filePath);
                    if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s2-reduce') !== false) {
                        $pageName = str_replace('-s2-reduce', '', $pathInfo['filename']);
                        $targetFileName = $pageName . '-s3-links';
                        $targetFilePath = $this->outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.html';
                        try {
                            $this->replaceLinksOfPage($filePath, $targetFilePath, $pageName);
                        } catch (Exception $e) {
                            file_put_contents($targetFilePath, file_get_contents($filePath));
                            $this->warn("Links of page %s could not be replaced (%s)!", $pageName, $e->getMessage());
                        }
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * Crawl TYPO3 Wiki page and replace its links by actual links.
     *
     * @param string $sourceFile Page content with TYPO3 Wiki links
     * @param string $targetFile Page content with actual links
     * @param string $pageName Page name
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    protected function replaceLinksOfPage(string $sourceFile, string $targetFile, string $pageName): void
    {
        $content = file_get_contents($sourceFile);
        preg_match_all('|<a[^>]*href="([^"]*)"[^>]*>(.*?)</a>|', $content, $nodes);
        $links = [];
        foreach ($nodes[0] as $id => $node) {
            $links[] = [
                'node' => $node,
                'text' => $nodes[2][$id],
                'url' => $nodes[1][$id],
                'urlAbs' => $this->getAbsoluteUri($nodes[1][$id]),
                'urlActual' => $this->resolveWikiFileUrl($this->getAbsoluteUri($nodes[1][$id]))
            ];
        }

        if (count($links) > 0) {
            $client = HttpClient::create();
            $responses = [];
            $replace = [];

            foreach ($links as $link) {
                if (!array_key_exists($link['urlActual'], $this->urlMap) && !array_key_exists($link['urlActual'], $responses)) {
                    if (empty($this->urlMapOfFailed[$link['urlActual']])) {
                        $responses[$link['urlActual']] = $client->request('GET', $link['urlActual']);
                    } else {
                        $responses[$link['urlActual']] = $client->request('GET', $this->urlMapOfFailed[$link['urlActual']]);
                    }
                }
            }

            foreach ($responses as $requestUrl => $response) {
                try {
                    $linkContent = $response->getContent(false);
                    if ($response->getStatusCode() === 200) {
                        if ($this->isWikiFileUrl($requestUrl)) {
                            $localFileUrl = $this->saveFileToLocal($requestUrl, $linkContent);
                            $this->urlMap[$requestUrl] = $localFileUrl;
                            $this->info("Url %s is confirmed and downloaded to %s.", $requestUrl, $localFileUrl);
                        } else {
                            if ($requestUrl !== $response->getInfo('url')) {
                                $this->info("Url %s redirects to %s.", $requestUrl, $response->getInfo('url'));
                                $this->urlMap[$requestUrl] = $response->getInfo('url');
                            } else {
                                $this->info("Url %s is confirmed.", $requestUrl);
                                $this->urlMap[$requestUrl] = $response->getInfo('url');
                            }
                        }
                    } else {
                        $this->warn("Url %s seems to be outdated (status code: %s)!", $requestUrl, $response->getStatusCode());
                        $this->urlMap[$requestUrl] = '';
                    }
                } catch (Exception $e) {
                    $this->warn("Url %s seems to be outdated (%s)!", $requestUrl, $e->getMessage());
                    $this->urlMap[$requestUrl] = '';
                }
            }

            foreach ($links as $link) {
                $actualUrl = $this->urlMap[$link['urlActual']];
                if ($actualUrl !== '') {
                    if (strpos($actualUrl, $this->wikiUrl) !== 0) {
                        if (strpos($link['urlActual'], $this->wikiUrl) === 0 || !empty($this->urlMapOfFailed[$link['urlActual']])) {
                            $actualNode = str_replace($link['url'], $actualUrl, $link['node']);
                            $replace[$link['node']] = $actualNode;
                            $this->info("Link %s of page %s gets replaced by %s.", $link['urlAbs'], $pageName, $actualUrl);
                        }
                    } else {
                        $actualNode = str_replace($link['url'], $link['urlAbs'], $link['node']);
                        $replace[$link['node']] = $actualNode . ' [deprecated wiki link]';
                        $this->warn("Link %s of page %s gets marked as outdated as it links to deprecated wiki instance.", $link['urlAbs'], $pageName);
                    }
                } else {
                    $actualNode = str_replace($link['url'], $link['urlAbs'], $link['node']);
                    $replace[$link['node']] = $actualNode . ' [not available anymore]';
                    $this->warn("Link %s of page %s gets marked as outdated as it is not available.", $link['urlAbs'], $pageName);
                }
            }

            if (count($replace)) {
                $content = str_replace(
                    array_keys($replace),
                    array_values($replace),
                    $content
                );
            }
        }

        file_put_contents($targetFile, $content);
    }

    protected function getAbsoluteUri(string $url): string
    {
        return strpos($url, 'http') === 0 ? $url :
            (strpos($url, '/') === 0 ? $this->wikiUrl . $url :
                $this->wikiUrl . '/' . $url);
    }

    protected function resolveWikiFileUrl(string $sourceFile): string
    {
        $targetFile = $this->getWikiFileLinkFromThumbnailLink($sourceFile);
        $targetFile = $this->getWikiFileLinkFromImageLink($targetFile);
        $targetFile = $this->getWikiFileUrlFromWikiFileLink($targetFile);
        return $targetFile;
    }

    protected function getWikiFileLinkFromThumbnailLink(string $sourceFile): string
    {
        $targetFile = $sourceFile;
        if (strpos($sourceFile, $this->wikiUrl) === 0 && strpos($sourceFile, '/thumb/') !== false) {
            preg_match('|/thumb/[a-z0-9]{1}/[a-z0-9]{2}/(.*?)/|', $sourceFile, $matches);
            $targetFile = sprintf('%s/File:%s', $this->wikiUrl, $matches[1]);
        }
        return $targetFile;
    }

    protected function getWikiFileLinkFromImageLink(string $sourceFile): string
    {
        $targetFile = $sourceFile;
        if (strpos($sourceFile, $this->wikiUrl) === 0 && strpos($sourceFile, '/images/') !== false) {
            preg_match('|/images/[a-z0-9]{1}/[a-z0-9]{2}/(.*)|', $sourceFile, $matches);
            $targetFile = sprintf('%s/File:%s', $this->wikiUrl, $matches[1]);
        }
        return $targetFile;
    }

    protected function getWikiFileUrlFromWikiFileLink(string $sourceFile): string
    {
        $targetFile = $sourceFile;
        if (strpos($sourceFile, $this->wikiUrl) === 0) {
            $targetFile = str_replace('/File:', '/Special:FilePath/', $sourceFile);
        }
        return $targetFile;
    }

    protected function isWikiFileUrl(string $sourceFile): bool
    {
        return strpos($sourceFile, $this->wikiUrl) === 0 && strpos($sourceFile, '/Special:FilePath/') !== false;
    }

    protected function removeWikiFileLinkSyntax(string $sourceFile): string
    {
        $targetFile = $sourceFile;
        if (strpos($sourceFile, $this->wikiUrl) === 0) {
            $targetFile = str_replace('/File:', '/', $sourceFile);
        }
        return $targetFile;
    }

    /**
     * Crawl TYPO3 Wiki pages and save their images into the folder $this->filesDir.
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    protected function fetchImagesOfPages(): void
    {
        if ($handle = opendir($this->outputDir)) {
            while (false !== ($file = readdir($handle))) {
                $filePath = $this->outputDir . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    $pathInfo = pathinfo($filePath);
                    if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s3-links') !== false) {
                        $pageName = str_replace('-s3-links', '', $pathInfo['filename']);
                        $targetFileName = $pageName . '-s4-images';
                        $targetFilePath = $this->outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.html';
                        try {
                            $this->fetchImagesOfPage($filePath, $targetFilePath, $pageName);
                        } catch (Exception $e) {
                            file_put_contents($targetFilePath, file_get_contents($filePath));
                            $this->warn("Images of page %s could not be fetched (%s)!", $pageName, $e->getMessage());
                        }
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * Crawl TYPO3 Wiki page and save its images into the folder $this->filesDir.
     *
     * @param string $sourceFile Page content with TYPO3 Wiki image urls
     * @param string $targetFile Page content with local image urls
     * @param string $pageName Page name
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    protected function fetchImagesOfPage(string $sourceFile, string $targetFile, string $pageName): void
    {
        $content = file_get_contents($sourceFile);
        preg_match_all('|<img[^>]*src="([^"]*)"[^>]*>|', $content, $nodes);
        $images = [];
        foreach ($nodes[0] as $id => $node) {
            $images[] = [
                'node' => $node,
                'url' => $nodes[1][$id],
                'urlAbs' => $this->getAbsoluteUri($nodes[1][$id]),
                'urlActual' => $this->resolveWikiFileUrl($this->getAbsoluteUri($nodes[1][$id]))
            ];
        }

        if (count($images) > 0) {
            $client = HttpClient::create();
            $responses = [];
            $replace = [];

            foreach ($images as $image) {
                if (!array_key_exists($image['urlActual'], $this->urlMap) && !array_key_exists($image['urlActual'], $responses)) {
                    if (empty($this->urlMapOfFailed[$image['urlActual']])) {
                        $responses[$image['urlActual']] = $client->request('GET', $image['urlActual']);
                    } else {
                        $responses[$image['urlActual']] = $client->request('GET', $this->urlMapOfFailed[$image['urlActual']]);
                    }
                }
            }

            foreach ($responses as $requestUrl => $response) {
                try {
                    $imageContent = $response->getContent(false);
                    if ($response->getStatusCode() === 200) {
                        $localImageUrl = $this->saveFileToLocal($requestUrl, $imageContent);
                        $this->urlMap[$requestUrl] = $localImageUrl;
                        $this->info("Url %s is confirmed and downloaded to %s.", $requestUrl, $localImageUrl);
                    } else {
                        $this->urlMap[$requestUrl] = '';
                        $this->warn("Url %s seems to be outdated (status code: %s)!", $requestUrl, $response->getStatusCode());
                    }
                } catch (Exception $e) {
                    $this->urlMap[$requestUrl] = '';
                    $this->warn("Url %s seems to be outdated (%s)!", $requestUrl, $e->getMessage());
                }
            }

            foreach ($images as $image) {
                $localImageUrl = $this->urlMap[$image['urlActual']];
                if ($localImageUrl !== '') {
                    $actualNode = str_replace($image['url'], $localImageUrl, $image['node']);
                    $replace[$image['node']] = $actualNode;
                    $this->info("Image %s of page %s gets replaced by %s.", $image['url'], $pageName, $localImageUrl);
                } else {
                    $replace[$image['node']] = $image['urlActual'] . ' [outdated image]';
                    $this->warn("Image %s of page %s gets removed as it is outdated.", $image['url'], $pageName);
                }
            }

            if (count($replace)) {
                $content = str_replace(
                    array_keys($replace),
                    array_values($replace),
                    $content
                );
            }
        }

        file_put_contents($targetFile, $content);
    }

    /**
     * Save fetched file to local files folder and return path of local file.
     *
     * @param string $sourceFile Original file path
     * @param string $sourceContent Original file content
     * @return string Local file path
     */
    protected function saveFileToLocal(string $sourceFile, string $sourceContent): string
    {
        $sourceFile = $this->removeWikiFileLinkSyntax($sourceFile);
        $pathInfo = pathinfo(parse_url($sourceFile)['path']);
        $fileName = $pathInfo['filename'];
        $fileExt = $pathInfo['extension'];
        $fileNameAndExt = $fileName . '.' . $fileExt;
        $suffix = 1;

        while (is_file($this->filesDir . DIRECTORY_SEPARATOR . $fileNameAndExt)) {
            $fileNameAndExt = $fileName . '-' . $suffix++ . '.' . $fileExt;
        }
        $this->createDir($this->filesDir);
        file_put_contents($this->filesDir . DIRECTORY_SEPARATOR . $fileNameAndExt, $sourceContent);

        return $this->filesUrl . '/' . $fileNameAndExt;
    }

    /**
     * Traverse folder and convert files from HTML to reST.
     */
    protected function convert(): void
    {
        if ($handle = opendir($this->outputDir)) {
            while (false !== ($file = readdir($handle))) {
                $filePath = $this->outputDir . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    $pathInfo = pathinfo($filePath);
                    if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s4-images') !== false) {
                        $pageName = str_replace('-s4-images', '', $pathInfo['filename']);
                        try {
                            $targetFileName = $pageName;
                            $targetFilePath = $this->outputDir . DIRECTORY_SEPARATOR . $targetFileName . '-s5-converted.rst';
                            $this->convertHtmlToRst($filePath, $targetFilePath);
                            $this->info("Page %s converted.", $pageName);
                        } catch (Exception $e) {
                            $this->warn("Page %s could not be converted (%s)!", $pageName, $e->getMessage());
                        }
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * Convert HTML file to reST file by using the external tool Pandoc - see https://pandoc.org/.
     *
     * @param $sourceFile
     * @param $targetFile
     * @throws Exception
     */
    protected function convertHtmlToRst($sourceFile, $targetFile): void
    {
        $headerIncludes = $this->projectDir . '/pandoc/header.rst.txt';

        exec(sprintf(
            'pandoc %s -f html -t rst -H %s -s -o %s', $sourceFile, $headerIncludes, $targetFile
        ), $output, $result);

        if ($result > 0) {
            throw new Exception(json_encode($output), $result);
        }
    }

    /**
     * Traverse folder and post-process reST files.
     */
    protected function postProcess(): void
    {
        if ($handle = opendir($this->outputDir)) {
            while (false !== ($file = readdir($handle))) {
                $filePath = $this->outputDir . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    $pathInfo = pathinfo($filePath);
                    if ($pathInfo['extension'] == 'rst' && strpos($pathInfo['filename'], '-s5-converted') !== false) {
                        $pageName = str_replace('-s5-converted', '', $pathInfo['filename']);
                        try {
                            $targetFileName = $pageName;
                            $targetFilePath = $this->outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.rst';
                            $this->postProcessPage($filePath, $targetFilePath);
                            $this->info("Page %s post-processed.", $pageName);
                        } catch (Exception $e) {
                            $this->warn("Page %s could not be post-processed (%s)!", $pageName, $e->getMessage());
                        }
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * Post-process reST file.
     *
     * @param string $sourceFile
     * @param string $targetFile
     */
    protected function postProcessPage(string $sourceFile, string $targetFile): void
    {
        $content = file_get_contents($sourceFile);
        $this->postProcessContent($content);
        file_put_contents($targetFile, $content);
    }

    /**
     * Post-process reST file content.
     *
     * @param string $content
     */
    protected function postProcessContent(string &$content): void
    {
        /**
         * First-level heading
         * ===================
         * =>
         * ===================
         * First-level heading
         * ===================
         */
        $content = preg_replace("/\n\n([^\n]+)\n([=]+)\n\n/", "\n\n$2\n$1\n$2\n\n", $content);
        /**
         * Second-level heading
         * --------------------
         * =>
         * Second-level heading
         * ====================
         */
        $content = preg_replace_callback("/\n\n([^\n]+)\n([-]+)\n\n/", function($matches) {
            return sprintf("\n\n%s\n%s\n\n", $matches[1], str_repeat('=', strlen($matches[2])));
        }, $content);
        /**
         * Third-level heading
         * ~~~~~~~~~~~~~~~~~~~
         * =>
         * Third-level heading
         * -------------------
         */
        $content = preg_replace_callback("/\n\n([^\n]+)\n([~]+)\n\n/", function($matches) {
            return sprintf("\n\n%s\n%s\n\n", $matches[1], str_repeat('-', strlen($matches[2])));
        }, $content);
        /**
         * Remove self-targeting image links as they do not work after the sphinx conversion anymore:
         * Sphinx moves the images to the folder _images but forgets to adjust the links to the images
         * accordingly.
         * Use sphinx configuration param "html_scaled_image_link" instead if self-linking should be
         * supported.
         *
         * .. |Extension Upload screen TER.png| image:: files/Extension_Upload_screen_TER.png
         *    :target: files/Extension_Upload_screen_TER.png
         * =>
         * .. |Extension Upload screen TER.png| image:: files/Extension_Upload_screen_TER.png
         */
        $content = preg_replace(sprintf("|\n.*?:target: %s/.*?\n|", $this->filesUrl), "\n", $content);
    }

    protected function info(string $message, ...$args): void
    {
        $this->log(self::LOGLEVEL_INFO, $message, ...$args);
    }

    protected function warn(string $message, ...$args): void
    {
        $this->log(self::LOGLEVEL_WARNING, $message, ...$args);
    }

    protected function log(int $level, string $message, ...$args): void
    {
        $levelPrefix = [
            self::LOGLEVEL_INFO => '[I] ',
            self::LOGLEVEL_WARNING => '[W] ',
        ];

        if ($level >= $this->logLevel) {
            printf($levelPrefix[$level] . $message . "\n", ...$args);
        }

        if ($level >= self::LOGLEVEL_WARNING) {
            file_put_contents($this->outputDir . DIRECTORY_SEPARATOR . '_warnings.txt', sprintf($message . "\n", ...$args), FILE_APPEND);
        }
    }

    public function setWikiUrl(string $wikiUrl): void
    {
        $this->wikiUrl = $wikiUrl;
    }

    public function setWikiApiUrl(string $wikiApiUrl): void
    {
        $this->wikiApiUrl = $wikiApiUrl;
    }

    public function setKeepTemporaryFiles(bool $keepTemporaryFiles): void
    {
        $this->keepTemporaryFiles = $keepTemporaryFiles;
    }

    public function setIncludePages(array $includePages): void
    {
        $this->includePages = array_map([$this, 'getAbsoluteUri'], $includePages);
    }

    public function setLogLevel(int $logLevel): void
    {
        $this->logLevel = $logLevel;
    }
}
