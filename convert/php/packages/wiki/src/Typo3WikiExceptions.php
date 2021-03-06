<?php

declare(strict_types=1);

namespace Typo3\Wiki;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class Typo3WikiExceptions extends Wiki
{
    public function __construct(string $outputDir)
    {
        parent::__construct(
            'https://wiki.typo3.org',
            'https://wiki.typo3.org/api.php',
            $outputDir
        );

        $this->setIsWikiDeprecated(true);
    }

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
        $excludePagesIndex = array_flip([$this->wikiUrl . '/Exception']);

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
            if ($this->limitPages !== self::NO_LIMIT_OF_PAGES && count($this->pages) >= $this->limitPages) {
                break;
            }
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

    protected function reduceContent(&$content, $pageName): void
    {
        parent::reduceContent($content, $pageName);

        $title = sprintf('TYPO3 Exception %s', $pageName);
        $content = preg_replace('/(<h1[^>]*>)(.*)(<\/h1>)/', sprintf('$1%s$3', $title), $content, 1);
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
         * First-level heading
         * ===================
         *
         * .. include:: /If-you-encounter-this-exception.rst.txt
         */
        $note = trim('
.. include:: /If-you-encounter-this-exception.rst.txt
        ');
        $content = preg_replace("/\n\n([^\n]+)\n([=]+)\n/", sprintf("\n\n$1\n$2\n\n%s\n", $note), $content);

        parent::postProcessContent($content);
    }
}
