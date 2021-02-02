<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

define('WIKI_URL', 'https://wiki.typo3.org');

// Public
$keepTemporaryFiles = false;
$includePages = [];

// Private
$projectDir = dirname(dirname(__FILE__));
$outputDir = $projectDir . DIRECTORY_SEPARATOR . 'output';
$imagesDir = $outputDir . DIRECTORY_SEPARATOR . 'images';
$outputUrl = '/output';
$imagesUrl = $outputUrl . '/' . 'images';
$pages = [];
$imagesMap = [];

cleanDir($imagesDir);
cleanDir($outputDir);
createDir($outputDir);
fetchListOfExceptionPages();
fetchExceptionPages();
reduceExceptionPages();
fetchImagesOfExceptionPages();
convert();
if (!$keepTemporaryFiles) {
    cleanDir($outputDir, '/\.html$/');
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
        printf("Folder %s created.\n", $folder);
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
    printf("Folder %s cleaned up.\n", $folder);
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
                printf("Page %s fetched.\n", $response->getInfo('url'));
            } else {
                printf("Page %s not fetched (status code: %s)!\n", $response->getInfo('url'), $response->getStatusCode());
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
                        printf("Page %s reduced.\n", $pageName);
                    } catch (\Exception $e) {
                        printf("Page %s could not be reduced (%s)!\n", $pageName, $e->getMessage());
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
    $content = $crawler->filterXPath('//div[@class="mw-parser-output"]/*[not(contains(@class, "toc"))]')
        ->each(function(Crawler $node){return $node->outerHtml();});

    $content = preg_replace('/class="[^"]*"/', '', $content);
    $content = preg_replace('/width="[^"]*"/', '', $content);
    $content = preg_replace('/height="[^"]*"/', '', $content);

    file_put_contents($targetFile, $title . "\n\n" . implode("\n\n", $content));
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
                if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s2-reduce') !== false) {
                    $pageName = str_replace('-s2-reduce', '', $pathInfo['filename']);
                    try {
                        $targetFileName = $pageName . '-s3-images-fetched';
                        $targetFilePath = $outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.html';
                        fetchImagesOfExceptionPage($filePath, $targetFilePath, $pageName);
                    } catch (\Exception $e) {
                        printf("Images of page %s could not be fetched (%s)!\n", $pageName, $e->getMessage());
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
                printf("Image %s of page %s is out of wiki scope and not fetched.\n", $imageSrc, $pageName);
            }
        }

        if (count($responses) > 0) {
            foreach ($responses as $response) {
                $imageContent = $response->getContent(false);
                $imageUrl = $response->getInfo('url');
                if ($response->getStatusCode() === 200) {
                    createDir($imagesDir);
                    file_put_contents($imagesMap[$imageUrl], $imageContent);
                    printf("Image %s of page %s fetched.\n", $imageUrl, $pageName);
                } else {
                    printf("Image %s of page %s not fetched (status code: %s)!\n", $imageUrl, $pageName, $response->getStatusCode());
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
                if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-s3-images-fetched') !== false) {
                    $pageName = str_replace('-s3-images-fetched', '', $pathInfo['filename']);
                    try {
                        $targetFileName = $pageName;
                        $targetFilePath = $outputDir . DIRECTORY_SEPARATOR . $targetFileName . '.rst';
                        convertHtmlToRst($filePath, $targetFilePath);
                        printf("Page %s converted.\n", $pageName);
                    } catch (\Exception $e) {
                        printf("Page %s could not be converted (%s)!\n", $pageName, $e->getMessage());
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
    exec(sprintf('pandoc %s -f html -t rst -s -o %s', $sourceFile, $targetFile), $output, $result);
    if ($result > 0) {
        throw new Exception(json_encode($output), $result);
    }
}
