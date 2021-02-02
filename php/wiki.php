<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;

define('WIKI_URL', 'https://wiki.typo3.org');
define('LOGLEVEL_INFO', 1);
define('LOGLEVEL_WARNING', 2);

// Public
$keepTemporaryFiles = false;
$includePages = [];
$logLevel = LOGLEVEL_INFO;

// Private
$projectDir = dirname(dirname(__FILE__));
$outputDir = $projectDir . DIRECTORY_SEPARATOR . 'output';
$imagesDir = $outputDir . DIRECTORY_SEPARATOR . 'images';
$outputUrl = '/output';
$imagesUrl = $outputUrl . '/' . 'images';
$pages = [];
$imagesMap = [];
$linksMap = [];

cleanDir($imagesDir);
cleanDir($outputDir);
createDir($outputDir);
fetchListOfExceptionPages();
fetchExceptionPages();
reduceExceptionPages();
replaceWikiLinksOfExceptionPages();
fetchImagesOfExceptionPages();
convert();
postProcess();
if (!$keepTemporaryFiles) {
    cleanDir($outputDir, '/(\.html|-s5-converted\.rst)$/');
}

/**
 * Create directory if not exists.
 *
 * @param string $folder
 */
function createDir(string $folder): void
{
    if (!is_dir($folder)) {
        mkdir($folder);
        logInfo("Folder %s created.", $folder);
    }
}

/**
 * Clean up all specified files in folder and remove folder if empty.
 *
 * @param string $folder
 * @param string $filePattern
 */
function cleanDir(string $folder, string $filePattern = ''): void
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
    logInfo("Folder %s cleaned up.", $folder);
}

/**
 * Fetch list of TYPO3 Wiki exception pages.
 *
 * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
 */
function fetchListOfExceptionPages(): void
{
    global $includePages;
    global $pages;

    $client = HttpClient::create();
    $response = $client->request('GET', WIKI_URL . '/Special:PrefixIndex?prefix=Exception&namespace=0');
    $content = $response->getContent();
    $crawler = new Crawler($content);
    $pages = $crawler->filterXPath('//ul[@class="mw-prefixindex-list"]/li/a')
        ->reduce(function(Crawler $node) use($includePages){
            if (!empty($includePages)) {
                return in_array($node->text(), $includePages);
            } else {
                return !in_array($node->text(), ['Exception']);
            }
        })
        ->each(function(Crawler $node){
            return $node->text();
        });
}

/**
 * Crawl TYPO3 Wiki exception pages and save their content into folder $outputDir.
 */
function fetchExceptionPages(): void
{
    global $pages;
    global $outputDir;

    if (count($pages) > 0) {
        $client = HttpClient::create();
        $responses = [];
        foreach ($pages as $path) {
            $responses[] = $client->request('GET', WIKI_URL . '/' . $path);
        }
        foreach ($responses as $response) {
            $content = $response->getContent(false);
            if ($response->getStatusCode() === 200) {
                $uri = parse_url($response->getInfo('url'));
                $fileName = explode('/', $uri['path'])[3] . '-s1-full.html';
                file_put_contents($outputDir . DIRECTORY_SEPARATOR . $fileName, $content);
                logInfo("Page %s fetched.", $response->getInfo('url'));
            } else {
                logWarning("Page %s not fetched (status code: %s)!", $response->getInfo('url'), $response->getStatusCode());
            }
        }
    }
}

/**
 * Traverse folder and extract essential html from HTML files.
 */
function reduceExceptionPages(): void
{
    global $outputDir;

    if ($handle = opendir($outputDir)) {
        while (false !== ($file = readdir($handle))) {
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $pathInfo = pathinfo($filePath);
                if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s1-full') !== false) {
                    $pageName = str_replace('-s1-full', '', $pathInfo['filename']);
                    try {
                        $targetFileName = $pageName . '-s2-reduce';
                        $targetFilePath = $outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.html';
                        reduceExceptionPage($filePath, $targetFilePath);
                        logInfo("Page %s reduced.", $pageName);
                    } catch (\Exception $e) {
                        logWarning("Page %s could not be reduced (%s)!", $pageName, $e->getMessage());
                    }
                }
            }
        }
        closedir($handle);
    }
}

/**
 * Extract essential html parts like title and content from TYPO3 Wiki Exception page
 * and remove superfluous HTML attributes.
 *
 * @param string $sourceFile
 * @param string $targetFile
 */
function reduceExceptionPage(string $sourceFile, string $targetFile): void
{
    $crawler = new Crawler(file_get_contents($sourceFile));
    $title = $crawler->filterXPath('//h1[@id="firstHeading"]')->outerHtml();
    $body = $crawler->filterXPath('//div[@class="mw-parser-output"]/*[not(contains(@class, "toc"))]')
        ->each(function(Crawler $node){return $node->outerHtml();});

    $content = $title . "\n\n" . implode("\n\n", $body);
    $content = preg_replace('/id="[^"]*"/', '', $content);
    $content = preg_replace('/class="[^"]*"/', '', $content);
    $content = preg_replace('/width="[^"]*"/', '', $content);
    $content = preg_replace('/height="[^"]*"/', '', $content);
    $content = preg_replace('/<a[^>]*>\s*<\/a>/', '', $content);
    $content = preg_replace('/<p[^>]*>\s*<br>\s*<\/p>/', '', $content);

    file_put_contents($targetFile, $content);
}

/**
 * Traverse folder and replace internal wiki links by actual links outside of wiki scope - if available.
 *
 * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
 */
function replaceWikiLinksOfExceptionPages(): void
{
    global $outputDir;

    if ($handle = opendir($outputDir)) {
        while (false !== ($file = readdir($handle))) {
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $pathInfo = pathinfo($filePath);
                if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s2-reduce') !== false) {
                    $pageName = str_replace('-s2-reduce', '', $pathInfo['filename']);
                    $targetFileName = $pageName . '-s3-links';
                    $targetFilePath = $outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.html';
                    try {
                        replaceWikiLinksOfExceptionPage($filePath, $targetFilePath, $pageName);
                    } catch (\Exception $e) {
                        file_put_contents($targetFilePath, file_get_contents($filePath));
                        logWarning("Links of page %s could not be replaced (%s)!", $pageName, $e->getMessage());
                    }
                }
            }
        }
        closedir($handle);
    }
}

/**
 * Crawl TYPO3 Wiki exception page and replace its wiki links by actual links.
 *
 * @param string $sourceFile Exception page content with TYPO3 Wiki links
 * @param string $targetFile Exception page content with actual links
 * @param string $pageName Exception page name
 * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
 */
function replaceWikiLinksOfExceptionPage(string $sourceFile, string $targetFile, string $pageName): void
{
    global $linksMap;

    $content = file_get_contents($sourceFile);
    $crawler = new Crawler($content);
    $links = $crawler->filterXPath('//a')
        ->each(function(Crawler $node){return $node->attr('href');});

    if (count($links) > 0) {
        $client = HttpClient::create();
        $replace = [];
        $responses = [];

        foreach ($links as $link) {
            if (strpos($link, '/File:') === 0) {
                continue;
            }

            $linkAbs = strpos($link, 'http') === 0 ? $link :
                        (strpos($link, '/') === 0 ? WIKI_URL . $link :
                            WIKI_URL . '/' . $link);

            if (strpos($linkAbs, WIKI_URL) !== false) {
                if (!array_key_exists($link, $replace)) {
                    if (!array_key_exists($linkAbs, $linksMap)) {
                        $linksMap[$linkAbs] = $linkAbs;
                        $responses[$linkAbs] = $client->request('GET', $linkAbs);
                    } else {
                        if ($linksMap[$linkAbs] !== $linkAbs) {
                            $linkPath = preg_replace('/http[s]?:\/\/[^\/]+/', '', $linkAbs);
                            $replace[$linkAbs] = $linksMap[$linkAbs];
                            $replace[$linkPath] = $linksMap[$linkAbs];
                            $replace[substr($linkPath, 1)] = $linksMap[$linkAbs];
                        }
                    }
                }
            } else {
                if (!array_key_exists($linkAbs, $linksMap)) {
                    $linksMap[$linkAbs] = $linkAbs;
                    $responses[$linkAbs] = $client->request('GET', $linkAbs);
                }
            }
        }

        if (count($responses) > 0) {
            foreach ($responses as $requestUrl => $response) {
                try {
                    $response->getContent(false);
                    if ($response->getStatusCode() === 200) {
                        $responseUrl = $response->getInfo('url');
                        if (strpos($requestUrl, WIKI_URL) !== false && strpos($responseUrl, WIKI_URL) === false) {
                            $linksMap[$requestUrl] = $responseUrl;
                            $requestPath = preg_replace('/http[s]?:\/\/[^\/]+/', '', $requestUrl);
                            $replace[$requestUrl] = $responseUrl;
                            $replace[$requestPath] = $responseUrl;
                            $replace[substr($requestPath, 1)] = $responseUrl;
                            logInfo("Link %s of page %s replaced by link %s.", $requestUrl, $pageName, $responseUrl);
                        } else {
                            logInfo("Link %s of page %s remains as-is.", $requestUrl, $pageName);
                        }
                    } else {
                        logWarning("Link %s of page %s seems to be outdated (status code: %s)!", $requestUrl, $pageName, $response->getStatusCode());
                    }
                } catch (TransportException $e) {
                    logWarning("Link %s of page %s seems to be outdated (%s)!", $requestUrl, $pageName, $e->getMessage());
                }
            }
        }

        if (count($replace) > 0) {
            $content = str_replace(
                array_keys($replace),
                array_values($replace),
                $content
            );
            $content = str_replace(
                array_map('htmlspecialchars', array_keys($replace)),
                array_map('htmlspecialchars', array_values($replace)),
                $content
            );
        }
    }

    file_put_contents($targetFile, $content);
}

/**
 * Crawl TYPO3 Wiki exception pages and save their images into the folder $imagesDir.
 *
 * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
 */
function fetchImagesOfExceptionPages(): void
{
    global $outputDir;

    if ($handle = opendir($outputDir)) {
        while (false !== ($file = readdir($handle))) {
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $pathInfo = pathinfo($filePath);
                if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s3-links') !== false) {
                    $pageName = str_replace('-s3-links', '', $pathInfo['filename']);
                    $targetFileName = $pageName . '-s4-images';
                    $targetFilePath = $outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.html';
                    try {
                        fetchImagesOfExceptionPage($filePath, $targetFilePath, $pageName);
                    } catch (\Exception $e) {
                        file_put_contents($targetFilePath, file_get_contents($filePath));
                        logWarning("Images of page %s could not be fetched (%s)!", $pageName, $e->getMessage());
                    }
                }
            }
        }
        closedir($handle);
    }
}

/**
 * Crawl TYPO3 Wiki exception page and save its images into the folder $imagesDir.
 *
 * @param string $sourceFile Exception page content with TYPO3 Wiki image urls
 * @param string $targetFile Exception page content with local image urls
 * @param string $pageName Exception page name
 * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
 * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
 */
function fetchImagesOfExceptionPage(string $sourceFile, string $targetFile, string $pageName): void
{
    global $imagesDir;
    global $imagesUrl;
    global $imagesMap;

    $content = file_get_contents($sourceFile);
    $crawler = new Crawler($content);
    $images = $crawler->filterXPath('//img')
        ->each(function(Crawler $node){return $node->attr('src');});

    if (count($images) > 0) {
        $client = HttpClient::create();
        $replace = [];
        $responses = [];

        foreach ($images as $imageSrc) {
            $imageSrcAbs = strpos($imageSrc, 'http') === 0 ? $imageSrc :
                            (strpos($imageSrc, '/') === 0 ? WIKI_URL . $imageSrc :
                            WIKI_URL . '/' . $imageSrc);

            if (strpos($imageSrcAbs, WIKI_URL) !== false) {
                if (!array_key_exists($imageSrc, $replace)) {
                    $imageSrcPath = parse_url($imageSrcAbs)['path'];
                    $imageUrl = getOriginalImageFromPotentialThumbnail($imageSrcAbs);
                    $imageNameAndExt = pathinfo(parse_url($imageUrl)['path'])['basename'];
                    $localImageUrl = $imagesUrl . '/' . $imageNameAndExt;
                    $localImagePath = $imagesDir . DIRECTORY_SEPARATOR . $imageNameAndExt;
                    $replace[$imageSrcAbs] = $localImageUrl;
                    $replace[$imageSrcPath] = $localImageUrl;
                    $replace[substr($imageSrcPath, 1)] = $localImageUrl;
                    if (!array_key_exists($imageUrl, $imagesMap)) {
                        $imagesMap[$imageUrl] = $localImagePath;
                        $responses[] = $client->request('GET', $imageUrl);
                    }
                }
            } else {
                logInfo("Image %s of page %s is out of wiki scope and not fetched.", $imageSrc, $pageName);
            }
        }

        if (count($responses) > 0) {
            foreach ($responses as $response) {
                $imageContent = $response->getContent(false);
                $imageUrl = $response->getInfo('url');
                if ($response->getStatusCode() === 200) {
                    createDir($imagesDir);
                    file_put_contents($imagesMap[$imageUrl], $imageContent);
                    logInfo("Image %s of page %s fetched.", $imageUrl, $pageName);
                } else {
                    logWarning("Image %s of page %s not fetched (status code: %s)!", $imageUrl, $pageName, $response->getStatusCode());
                }
            }
        }

        if (count($replace) > 0) {
            $content = str_replace(array_keys($replace), array_values($replace), $content);
        }
    }

    file_put_contents($targetFile, $content);
}

/**
 * Extract the original image path from a potential TYPO3 Wiki thumbnail path, e.g.
 * https://wiki.typo3.org/wiki/images/thumb/d/d1/Extension_Upload_screen_TER.png/300px-Extension_Upload_screen_TER.png
 * =>
 * https://wiki.typo3.org/wiki/images/d/d1/Extension_Upload_screen_TER.png
 *
 * @param string $sourceFile Potential thumbnail image path
 * @return string Original image path
 */
function getOriginalImageFromPotentialThumbnail(string $sourceFile): string
{
    $targetFile = $sourceFile;
    if (strpos($sourceFile, '/thumb/') !== false) {
        $targetFile = str_replace('/thumb', '', $targetFile);
        $targetFile = substr($targetFile, 0, strrpos($targetFile, '/'));
    }
    return $targetFile;
}

/**
 * Traverse folder and convert files from HTML to reST.
 */
function convert(): void
{
    global $outputDir;

    if ($handle = opendir($outputDir)) {
        while (false !== ($file = readdir($handle))) {
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $pathInfo = pathinfo($filePath);
                if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s4-images') !== false) {
                    $pageName = str_replace('-s4-images', '', $pathInfo['filename']);
                    try {
                        $targetFileName = $pageName;
                        $targetFilePath = $outputDir . DIRECTORY_SEPARATOR . $targetFileName . '-s5-converted.rst';
                        convertHtmlToRst($filePath, $targetFilePath);
                        logInfo("Page %s converted.", $pageName);
                    } catch (\Exception $e) {
                        logWarning("Page %s could not be converted (%s)!", $pageName, $e->getMessage());
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
function convertHtmlToRst($sourceFile, $targetFile): void
{
    global $projectDir;

    $headerIncludes = $projectDir . '/pandoc/header.rst.txt';

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
function postProcess(): void
{
    global $outputDir;

    if ($handle = opendir($outputDir)) {
        while (false !== ($file = readdir($handle))) {
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $pathInfo = pathinfo($filePath);
                if ($pathInfo['extension'] == 'rst' && strpos($pathInfo['filename'], '-s5-converted') !== false) {
                    $pageName = str_replace('-s5-converted', '', $pathInfo['filename']);
                    try {
                        $targetFileName = $pageName;
                        $targetFilePath = $outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.rst';
                        postProcessRst($filePath, $targetFilePath);
                        logInfo("Page %s post-processed.", $pageName);
                    } catch (\Exception $e) {
                        logWarning("Page %s could not be post-processed (%s)!", $pageName, $e->getMessage());
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
 * @param $sourceFile
 * @param $targetFile
 */
function postProcessRst($sourceFile, $targetFile): void
{
    $content = file_get_contents($sourceFile);
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

    file_put_contents($targetFile, $content);
}

function logInfo(string $message, ...$args): void
{
    logg(LOGLEVEL_INFO, $message, ...$args);
}

function logWarning(string $message, ...$args): void
{
    logg(LOGLEVEL_WARNING, $message, ...$args);
}

function logg(int $level, string $message, ...$args): void
{
    global $logLevel;
    global $outputDir;

    if ($level >= $logLevel) {
        printf($message . "\n", ...$args);
    }

    if ($level >= LOGLEVEL_WARNING) {
        file_put_contents($outputDir . DIRECTORY_SEPARATOR . 'warnings.txt', sprintf($message . "\n", ...$args), FILE_APPEND);
    }
}
