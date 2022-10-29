<?php

declare(strict_types=1);
/**
 * happy coding.
 */
use KLog\Controller\CpuController;
use KLog\Controller\MemController;
use KLog\Controller\NetController;
use KLog\Lib\Config\Config;
use KLog\Lib\Config\ConfigInterface;
use KLog\Lib\Logger\Logger;
use KLog\Lib\Logger\LoggerInterface;
use KLog\Lib\Router\Listener\RouterParserListener;
use KLog\Server\Listener\ServerListener;
use KLog\Server\Listener\WebSocketClosedListener;
use KLog\Server\Listener\WebSocketReceivedListener;

return [
    'enable' => true,
    'server' => [
        'name' => 'KLog_server',
        'host' => '127.0.0.1',
        'port' => 9028,
    ],
    'dependency' => [
        ConfigInterface::class => Config::class,
        LoggerInterface::class => Logger::class,
    ],
    'listeners' => [
        ServerListener::class,
        WebSocketReceivedListener::class,
        WebSocketClosedListener::class,
        RouterParserListener::class,
    ],
    'router' => [
        'stat/cpu' => CpuController::class,
        'stat/mem' => MemController::class,
        'stat/net' => NetController::class,
    ],
];
