<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Lib\Logger\Handel;

use KLog\Lib\Logger\Handel\Formatter\FormatterInterface;

class SimpleLoggerHandel implements LoggerHandelInterface
{
    public function write(FormatterInterface $formatter)
    {
        var_dump($formatter->handel());
    }
}
