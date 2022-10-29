<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Lib\Middleware;

use KLog\Lib\Logger\LoggerInterface;
use KLog\Lib\Router\Router;

class Middleware
{
    protected LoggerInterface $logger;

    protected Router $router;

    public function __construct(LoggerInterface $logger, Router $router)
    {
        $this->router = $router;
        $this->logger = $logger;
    }

    public function handel(string $action, $request)
    {
        $data = $this->router->handel($action);
        $this->logger->info([
            'request' => $request,
            'response' => $data,
        ]);
        return $data;
    }
}
