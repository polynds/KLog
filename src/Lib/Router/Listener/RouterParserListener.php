<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Lib\Router\Listener;

use KLog\Lib\Event\ListenerInterface;
use KLog\Lib\Router\Router;
use KLog\Server\Event\ServerStartEvent;

class RouterParserListener implements ListenerInterface
{
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function listen(): array
    {
        return [
            ServerStartEvent::class,
        ];
    }

    public function process(object $event)
    {
        $this->router->parser();
    }
}
