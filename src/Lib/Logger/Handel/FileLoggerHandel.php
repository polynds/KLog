<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Lib\Logger\Handel;

use Carbon\Carbon;
use KLog\Lib\Logger\Handel\Formatter\FormatterInterface;

class FileLoggerHandel implements LoggerHandelInterface
{
    public function write(FormatterInterface $formatter)
    {
        file_put_contents($this->getLogName(), $formatter->handel());
    }

    private function getLogName(): string
    {
        return LOG_PATH . DIRECTORY_SEPARATOR . Carbon::now()->format('Y-m-d-H') . '.log';
    }
}
