<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Lib\Logger;

use KLog\Lib\Logger\Handel\FileLoggerHandel;
use KLog\Lib\Logger\Handel\Formatter\SimpleFormatter;
use KLog\Lib\Logger\Handel\LoggerHandelInterface;

class Logger extends AbstractLogger
{
    protected LoggerHandelInterface $loggerHandel;

    public function __construct()
    {
        $this->loggerHandel = new FileLoggerHandel();
    }

    public function call(string $level, $message, array $context = [])
    {
        $this->loggerHandel->write(new SimpleFormatter($level, $message, $context));
    }

    public function emergency($message, array $context = [])
    {
        $this->call(self::LEVEL_EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->call(self::LEVEL_ALERT, $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->call(self::LEVEL_CRITICAL, $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->call(self::LEVEL_ERROR, $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->call(self::LEVEL_WARNING, $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->call(self::LEVEL_NOTICE, $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->call(self::LEVEL_INFO, $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->call(self::LEVEL_DEBUG, $message, $context);
    }

    public function log($message, array $context = [])
    {
        $this->call(self::LEVEL_LOG, $message, $context);
    }
}
