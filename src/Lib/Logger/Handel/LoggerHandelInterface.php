<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Lib\Logger\Handel;

use KLog\Lib\Logger\Handel\Formatter\FormatterInterface;

interface LoggerHandelInterface
{
    public function write(FormatterInterface $formatter);
}
