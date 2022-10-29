<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Server\Listener;

use KLog\Lib\Event\ListenerInterface;
use KLog\Lib\Logger\LoggerInterface;
use KLog\Server\Event\ServerStartEvent;
use KLog\Server\Event\ServerStopEvent;

class ServerListener implements ListenerInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function listen(): array
    {
        return [
            ServerStartEvent::class,
            ServerStopEvent::class,
        ];
    }

    public function process(object $event)
    {
        if ($event instanceof ServerStartEvent) {
            $this->logger->info('KLogServer started.');
        } elseif ($event instanceof ServerStopEvent) {
            $this->logger->info('KLogServer stoped.');
        }
    }
}
