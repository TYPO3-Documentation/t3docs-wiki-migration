<?php

declare(strict_types=1);

namespace Typo3\Wiki;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class WikiExceptions extends AbstractWiki
{
    /**
     * Fetch list of TYPO3 Wiki exception pages.
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
            'gapprefix' => 'Exception',
            'prop' => 'info',
            'inprop' => 'url',
            'format' => 'json',
            'gaplimit' => 500,
        ];
        $pages = [];
        $includePagesIndex = array_flip($this->includePages);
        $excludePagesIndex = array_flip([self::WIKI_URL . '/Exception']);

        do {
            $response = $client->request('GET', self::WIKI_API_URL, ['query' => $query + [
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
                if (!isset($excludePagesIndex[$page['canonicalurl']])) {
                    $this->pages[] = $page['canonicalurl'];
                }
            }
        }

        $this->info("%d exception pages will be fetched.", count($this->pages));
    }

    /**
     * Convert PageName into page-id with prefix "exception-".
     *
     * @param string $pageName
     * @return string Page ID
     */
    protected function getPageId(string $pageName): string
    {
        return 'typo3-exception-' . parent::getPageId($pageName);
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
        $crawler = new Crawler(file_get_contents($sourceFile));
        $title = sprintf('<h1>TYPO3 Exception %s</h1>', $pageName);
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

        file_put_contents($targetFile, $content);
    }
}
