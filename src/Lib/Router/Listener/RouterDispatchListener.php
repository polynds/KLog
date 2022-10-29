<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Lib\Router\Listener;

use KLog\Lib\Event\ListenerInterface;
use KLog\Lib\Router\Router;
use KLog\Server\Event\RouterDispatchEvent;

class RouterDispatchListener implements ListenerInterface
{
    protected Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function listen(): array
    {
        return [
            RouterDispatchEvent::class,
        ];
    }

    public function process(object $event)
    {
        $psrRequest = $event->getRequest();
        $psrResponse = $event->getResponse();
        $this->router->handel($psrRequest, $psrResponse);
    }
}
