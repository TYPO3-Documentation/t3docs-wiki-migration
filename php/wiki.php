<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

$folder = '/source';
$keepTemporaryFiles = false;

cleanup($folder);
fetchExceptionPages($folder);
convert($folder);
if (!$keepTemporaryFiles) {
    cleanup($folder, '/\.html$/');
}

/**
 * Clean up all HTML and reST files in folder.
 *
 * @param string $folder
 * @param string $filePattern
 */
function cleanup(string $folder, string $filePattern = '/(\.html|\.rst)$/'): void
{
    if ($handle = opendir($folder)) {
        while (false !== ($file = readdir($handle))) {
            $filePath = $folder . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $pathInfo = pathinfo($filePath);
                if (preg_match($filePattern, $pathInfo['basename'])) {
                    unlink($filePath);
                }
            }
        }
        closedir($handle);
    }
    printf("Folder %s cleaned up.\n", $folder);
}

/**
 * Crawl TYPO3 Wiki exception pages and save their content into the specified folder.
 *
 * @param string $folder
 */
function fetchExceptionPages(string $folder): void
{
    $baseUri = 'https://wiki.typo3.org';
    $pathExceptions = 'Special:PrefixIndex?prefix=Exception&namespace=0';

    $client = HttpClient::create();
    $response = $client->request('GET', $baseUri . '/' . $pathExceptions);
    $content = $response->getContent();
    $crawler = new Crawler($content);
    $pathException = $crawler->filterXPath('//ul[@class="mw-prefixindex-list"]/li/a')
        ->reduce(function(Crawler $node){return !in_array($node->text(), ['Exception']);})
        ->each(function(Crawler $node){return $node->text();});

    if (count($pathException) > 0) {
        $responses = [];
        foreach ($pathException as $path) {
            $responses[] = $client->request('GET', $baseUri . '/' . $path);
        }
        foreach ($responses as $response) {
            $content = $response->getContent(false);
            if ($response->getStatusCode() === 200) {
                $uri = parse_url($response->getInfo('url'));
                $filename = explode('/', $uri['path'])[3] . '.html';
                file_put_contents($folder . DIRECTORY_SEPARATOR . $filename, $content);
                printf("%s fetched.\n", $response->getInfo('url'));
            } else {
                printf("%s not fetched (status code %s)!\n", $response->getInfo('url'), $response->getStatusCode());
            }
        }
    }
}

/**
 * Traverse folder, extract essential html from HTML files and convert to reST files.
 *
 * @param string $folder
 * @throws Exception
 */
function convert(string $folder): void
{
    if ($handle = opendir($folder)) {
        while (false !== ($file = readdir($handle))) {
            $filePath = $folder . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $pathInfo = pathinfo($filePath);
                if ($pathInfo['extension'] == 'html' && strpos($pathInfo['filename'], '-extract') === false) {
                    try {
                        $extractFilePath = $folder . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '-extract.html';
                        $rstFilePath = $folder . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.rst';
                        extractHtmlOfExceptionPage($filePath, $extractFilePath);
                        convertHtmlToRst($extractFilePath, $rstFilePath);
                        printf("%s converted.\n", $file);
                    } catch (\Exception $e) {
                        printf("%s could not be converted (%s).\n", $file, $e->getMessage());
                    }
                }
            }
        }
        closedir($handle);
    }
}

/**
 * Extract essential html parts like title and content from TYPO3 Wiki Exception page,
 * e.g. from https://wiki.typo3.org/Exception/CMS/1237900529
 *
 * @param $sourceFile
 * @param $targetFile
 */
function extractHtmlOfExceptionPage($sourceFile, $targetFile): void
{
    $crawler = new Crawler(file_get_contents($sourceFile));
    $title = $crawler->filterXPath('//h1[@id="firstHeading"]')->outerHtml();
    $content = $crawler->filterXPath('//div[@class="mw-parser-output"]/*[not(contains(@class, "toc"))]')
        ->each(function(Crawler $node){return $node->outerHtml();});

    file_put_contents($targetFile, $title . "\n\n" . implode("\n\n", $content));
}

/**
 * Convert HTML file to reST file by using external tool Pandoc,
 * see https://pandoc.org/
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
