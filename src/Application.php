<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog;

use KLog\Lib\Config\Config;
use KLog\Lib\Config\ConfigInterface;
use KLog\Lib\Event\EventDispatcherFactory;
use KLog\Lib\Logger\Logger;
use KLog\Lib\Logger\LoggerInterface;
use KLog\Server\Server;

class Application
{
    protected EventDispatcherFactory $eventDispatcherFactory;

    protected Server $server;

    public function __construct()
    {
        $this->loadDependency();

        $this->eventDispatcherFactory = ApplicationContext::getContainer()->get(EventDispatcherFactory::class);
        $this->server = ApplicationContext::getContainer()->get(Server::class);
    }

    public function run()
    {
        if (! extension_loaded('swoole')) {
            return;
        }

        $this->eventDispatcherFactory->collect();

        $this->server->start();
    }

    protected function loadDependency()
    {
        ApplicationContext::getContainer()->set(ConfigInterface::class, ApplicationContext::getContainer()->get(Config::class));
        ApplicationContext::getContainer()->set(LoggerInterface::class, ApplicationContext::getContainer()->get(Logger::class));
    }
}
