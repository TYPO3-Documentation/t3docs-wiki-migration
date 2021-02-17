<?php

declare(strict_types=1);

namespace Typo3\ExceptionPages;

class ExceptionCodes
{
    protected $exceptionCodes;

    protected $binDir;
    protected $typo3Dir;
    protected $filesDir;
    protected $file;

    public function __construct() {
        $this->binDir = dirname(__DIR__) . '/bin';
        $this->typo3Dir = dirname(__DIR__) . '/res/typo3';
        $this->filesDir = dirname(__DIR__) . '/res/exceptions';
        $this->file = 'exceptions.php';
    }

    public function fetchFiles(string $typo3ReleasePattern = '', bool $force = false): void
    {
        if (!is_dir($this->typo3Dir)) {
            exec(sprintf('git clone git://git.typo3.org/Packages/TYPO3.CMS.git %s', $this->typo3Dir));
        }

        chdir($this->typo3Dir);

        exec('git checkout master');
        exec('git pull');
        exec('git tag --list', $tags);

        $durationTotal = 0;
        $numTags = 0;

        if (!empty($typo3ReleasePattern)) {
            $this->info('Fetching the exception codes of TYPO3 releases of pattern "%s".', $typo3ReleasePattern);
        } else {
            $this->info('Fetching the exception codes of all TYPO3 releases.');
        }

        foreach ($tags as $tag) {
            if (empty($typo3ReleasePattern) || preg_match($typo3ReleasePattern, $tag) === 1) {
                $filePath = $this->filesDir . DIRECTORY_SEPARATOR . sprintf('exceptions-%s.json', $tag);
                if ($force || !is_file($filePath)) {
                    try {
                        $exceptionCodesJson = [];

                        $start = microtime(true);

                        exec(sprintf('git -c advice.detachedHead=false checkout %s', $tag));
                        exec(sprintf('%s/duplicateExceptionCodeCheck.sh -p', $this->binDir), $exceptionCodesJson);
                        $exceptionCodes = json_decode(implode('', $exceptionCodesJson), true);
                        file_put_contents($filePath, implode("\n", $exceptionCodesJson));

                        $duration = microtime(true) - $start;
                        $durationTotal += $duration;
                        $numTags++;

                        $this->info("Fetching %s exception codes of TYPO3 %s took %s seconds.",
                            $exceptionCodes['total'], $tag, number_format($duration, 2)
                        );
                    } catch (Exception $e) {
                        $this->error("Fetching the exception codes of TYPO3 %s failed (%s)!",
                            $tag, $e->getMessage()
                        );
                    }
                } else {
                    $this->info('Exception codes of TYPO3 %s already fetched.', $tag);
                }
            }
        }

        $this->info('Fetching the exception codes of %s TYPO3 releases took %s seconds.',
            $numTags, number_format($durationTotal, 2)
        );
    }

    public function mergeFiles(string $typo3ReleasePattern = '', string $fileName = ''): void
    {
        $exceptions = [];

        if (!empty($typo3ReleasePattern)) {
            $this->info('Merging the exception codes of TYPO3 releases of pattern "%s" to file "%s".',
                $typo3ReleasePattern, $fileName
            );
        } else {
            $this->info('Merging the exception codes of all TYPO3 releases to file "%s".',
                $fileName
            );
        }

        if ($handle = opendir($this->filesDir)) {
            while (false !== ($file = readdir($handle))) {
                $filePath = $this->filesDir . DIRECTORY_SEPARATOR . $file;
                if (is_file($filePath)) {
                    $pathInfo = pathinfo($filePath);
                    if ($pathInfo['extension'] === 'json') {
                        if (empty($typo3ReleasePattern) || preg_match($typo3ReleasePattern, $pathInfo['filename']) === 1) {
                            try {
                                $exceptionsOfFile = json_decode(file_get_contents($filePath), true);
                                $numExceptionsOfFile = 0;
                                if (is_array($exceptionsOfFile['exceptions'])) {
                                    $numExceptionsOfFile = count($exceptionsOfFile['exceptions']);
                                    if (empty($exceptions)) {
                                        $exceptions = $exceptionsOfFile['exceptions'];
                                    } else {
                                        foreach ($exceptionsOfFile['exceptions'] as &$code) {
                                            if (!isset($exceptions[$code])) {
                                                $exceptions[$code] = $code;
                                            }
                                        }
                                    }
                                }
                                $this->info("File %s contains %d exception codes.", $filePath, $numExceptionsOfFile);
                            } catch (\Exception $e) {
                                $this->error("File %s could not be parsed (%s)!", $filePath, $e->getMessage());
                            }
                        }
                    }
                }
            }
            closedir($handle);
        }

        ksort($exceptions);

        $fileName = !empty($fileName) ? $fileName : $this->file;
        $filePath = $this->filesDir . DIRECTORY_SEPARATOR . $fileName;
        $pathInfo = pathinfo($filePath);

        if ($pathInfo['extension'] === 'json') {
            file_put_contents(
                $filePath,
                json_encode([
                    'exceptions' => $exceptions,
                    'total' => count($exceptions),
                ], JSON_PRETTY_PRINT)
            );
        } else {
            file_put_contents(
                $filePath,
                sprintf("<?php\nreturn %s;", var_export([
                    'exceptions' => $exceptions,
                    'total' => count($exceptions),
                ], true))
            );
        }

        $this->info(
            "File %s contains %d exception codes in total.",
            $filePath,
            count($exceptions)
        );
    }

    public function isValid(string $exceptionCode): bool
    {
        $this->loadFile();
        return isset($this->exceptionCodes[$exceptionCode]);
    }

    protected function loadFile(): void
    {
        if (empty($this->exceptionCodes)) {
            if (is_file($this->filesDir . DIRECTORY_SEPARATOR . $this->file)) {
                $data = include $this->filesDir . DIRECTORY_SEPARATOR . $this->file;
                $this->exceptionCodes = $data['exceptions'];
            }
        }
    }

    protected function info(string $message, ...$args): void
    {
        $this->log(LOG_INFO, $message, ...$args);
    }

    protected function warn(string $message, ...$args): void
    {
        $this->log(LOG_WARNING, $message, ...$args);
    }

    protected function error(string $message, ...$args): void
    {
        $this->log(LOG_ERR, $message, ...$args);
    }

    protected function log(int $level, string $message, ...$args): void
    {
        $levelPrefix = [
            LOG_INFO => '[I] ',
            LOG_WARNING => '[W] ',
            LOG_ERR => '[E] ',
        ];

        printf($levelPrefix[$level] . $message . "\n", ...$args);
    }

    public function setTypo3Dir(string $typo3Dir): void
    {
        $this->typo3Dir = $typo3Dir;
    }

    public function setFilesDir(string $filesDir): void
    {
        $this->filesDir = $filesDir;
    }

    public function setFile(string $file): void
    {
        $this->file = $file;
    }
}