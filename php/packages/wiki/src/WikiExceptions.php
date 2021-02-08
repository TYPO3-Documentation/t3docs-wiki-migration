<?php

declare(strict_types=1);

namespace Typo3\Wiki;

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
        return 'exception-' . parent::getPageId($pageName);
    }
}
