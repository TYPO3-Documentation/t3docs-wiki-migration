<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

$sourceFolder = '/source';
$targetFolder = '/target';

try {
    cleanup($targetFolder);
    convert($sourceFolder, $targetFolder);
} catch (\Exception $e) {
    file_put_contents('php://stdout', $e);
}

/**
 * Clean up all HTML and reST files in target folder.
 *
 * @param string $targetFolder
 */
function cleanup(string $targetFolder): void
{
    if ($handle = opendir($targetFolder)) {
        while (false !== ($file = readdir($handle))) {
            $filePath = $targetFolder . DIRECTORY_SEPARATOR . $file;
            if (is_file($filePath)) {
                $pathInfo = pathinfo($filePath);
                if (in_array($pathInfo['extension'], ['html', 'rst'])) {
                    unlink($filePath);
                }
            }
        }
        closedir($handle);
    }
}

/**
 * Traverse source folder, extract essential html from HTML files and convert to reST files.
 *
 * @param string $sourceFolder
 * @param string $targetFolder
 * @throws Exception
 */
function convert(string $sourceFolder, string $targetFolder): void
{
    if ($handle = opendir($sourceFolder)) {
        while (false !== ($file = readdir($handle))) {
            $sourceFile = $sourceFolder . DIRECTORY_SEPARATOR . $file;
            if (is_file($sourceFile)) {
                $pathInfo = pathinfo($sourceFile);
                if ($pathInfo['extension'] == 'html') {
                    $targetHtmlFile = $targetFolder . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.html';
                    $targetRstFile = $targetFolder . DIRECTORY_SEPARATOR . $pathInfo['filename'] . '.rst';
                    extractHtmlOfException($sourceFile, $targetHtmlFile);
                    convertHtmlToRst($targetHtmlFile, $targetRstFile);
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
function extractHtmlOfException($sourceFile, $targetFile): void
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
