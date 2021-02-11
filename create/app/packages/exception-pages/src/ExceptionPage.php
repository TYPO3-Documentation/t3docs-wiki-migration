<?php

declare(strict_types=1);

namespace Typo3\ExceptionPages;

use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\HttpClient;

class ExceptionPage
{
    protected $exception;
    protected $action;

    protected $gitHubUser;
    protected $gitHubToken;
    protected $gitHubOwner;
    protected $gitHubRepository;
    protected $gitHubExceptionPath;
    protected $gitHubBranch;

    public function __construct(string $exception)
    {
        $this->exception = $exception;

        $this->gitHubOwner = 'TYPO3-Documentation';
        $this->gitHubRepository = 'TYPO3CMS-Exceptions';
        $this->gitHubExceptionPath = 'Documentation/Exceptions/%s.rst';
        $this->gitHubBranch = 'master';
    }

    public function run(): void
    {
        try {
            $this->checkExceptionNumber();
            if ($this->action === 'edit') {
                $this->createPage();
                $this->redirectToEditPage();
            } elseif ($this->action === 'source') {
                $this->showSourceOfDefaultPage();
            } else {
                $this->showDefaultPage();
            }
        } catch (\Exception $e) {
            $this->logError('%s (%s)', $e->getMessage(), $e->getCode());
            $this->showError();
        }
    }

    protected function checkExceptionNumber(): void
    {
        $exceptions = $this->getAvailableExceptions();
        $exceptionsIndex = array_flip($exceptions);
        if (!isset($exceptionsIndex[$this->exception])) {
            throw new \Exception('This is not a valid exception number', 4001);
        };
    }

    protected function getAvailableExceptions(): array
    {
        //TODO: Fetch official list of TYPO3 exceptions numbers.
        $dummyListOfExceptions = [
            '1234567890',
            '1234567891',
            '1234567892',
            '1234567893',
            '1234567894',
            '1234567895',
            '1234567896',
            '1234567897',
            '1234567898',
            '1234567899',
        ];
        return $dummyListOfExceptions;
    }

    protected function createPage(): void
    {
        $rst = file_get_contents(dirname(__DIR__) . '/res/default.rst');
        $rst = str_replace(['[[[Exception]]]'], [$this->exception], $rst);

        try {
            $client = HttpClient::create();
            $client->request('PUT',
                sprintf(
                    'https://api.github.com/repos/%s/%s/contents/%s',
                    $this->gitHubOwner,
                    $this->gitHubRepository,
                    sprintf($this->gitHubExceptionPath, $this->exception)
                ),
                ['headers' => [
                    'accept' => 'application/vnd.github.v3+json',
                ], 'auth_basic' => [
                    $this->gitHubUser, $this->gitHubToken
                ], 'json' => [
                    'message' => sprintf('[TASK] Create page for exception %s', $this->exception),
                    'content' => base64_encode($rst),
                    'branch' => $this->gitHubBranch
                ]]
            );
        } catch (ClientException $e) {
            // GitHub API error #422:
            // Exception page reST file already exists but is not yet converted and deployed as HTML
            // which means the user can continue to edit the page on GitHub.
            if ($e->getCode() !== 422) {
                throw $e;
            }
        }
    }

    protected function redirectToEditPage(): void
    {
        header(sprintf("Location: %s", sprintf(
            'https://github.com/%s/%s/edit/%s/%s',
            $this->gitHubOwner,
            $this->gitHubRepository,
            $this->gitHubBranch,
            sprintf($this->gitHubExceptionPath, $this->exception)
        )));
        exit;
    }

    protected function showSourceOfDefaultPage(): void
    {
        header('Content-Type: text/plain');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        $rst = file_get_contents(dirname(__DIR__) . '/res/default.rst');
        $rst = str_replace(['[[[Exception]]]'], [$this->exception], $rst);
        echo $rst;
        exit;
    }

    protected function showDefaultPage(): void
    {
        header('Content-Type: text/html');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        $page = file_get_contents(dirname(__DIR__) . '/res/page.html');
        $body = file_get_contents(dirname(__DIR__) . '/res/default.html');
        $page = str_replace(['[[[Body]]]', '[[[Exception]]]'], [$body, $this->exception], $page);
        echo $page;
        exit;
    }

    protected function logError(string $message, ...$args): void
    {
        error_log(sprintf($message, ...$args));
    }

    protected function showError(): void
    {
        header('Content-Type: text/html');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        $page = file_get_contents(dirname(__DIR__) . '/res/page.html');
        $body = file_get_contents(dirname(__DIR__) . '/res/error.html');
        $page = str_replace(['[[[Body]]]', '[[[Exception]]]'], [$body, $this->exception], $page);
        echo $page;
        exit;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function setGitHubUser(string $user): void
    {
        $this->gitHubUser = $user;
    }

    public function setGitHubToken(string $token): void
    {
        $this->gitHubToken = $token;
    }

    public function setGitHubOwner(string $owner): void
    {
        $this->gitHubOwner = $owner;
    }

    public function setGitHubRepository(string $repository): void
    {
        $this->gitHubRepository = $repository;
    }

    public function setGitHubExceptionPath(string $path): void
    {
        $this->gitHubExceptionPath = $path;
    }

    public function setGitHubBranch(string $branch): void
    {
        $this->gitHubBranch = $branch;
    }
}