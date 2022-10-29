<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Lib\Router;

use KLog\Exception\ControllerNotFoundException;
use KLog\Exception\RouterNotFoundException;
use KLog\Lib\Config\ConfigInterface;
use KLog\Lib\DI\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    protected ConfigInterface $config;

    protected ContainerInterface $container;

    protected array $routerMap = [];

    public function __construct(ConfigInterface $config, ContainerInterface $container)
    {
        $this->config = $config;
        $this->container = $container;
    }

    public function parser()
    {
        $routers = $this->config->get('router');
        foreach ($routers as $name => $class) {
            if (! class_exists($class)) {
                throw new ControllerNotFoundException();
            }

            $contorller = $this->container->get($class);
            if (! $contorller instanceof ControllerInterface) {
                throw new ControllerNotFoundException();
            }

            $this->routerMap[$name] = $contorller;
        }
    }

    public function handel(ServerRequestInterface $psrRequest, ResponseInterface $psrResponse)
    {
        $name = '';
        $handel = $this->match($name);
        return $handel->index($psrRequest);
    }

    protected function match(string $name): ControllerInterface
    {
        if (! isset($this->routerMap[$name])) {
            throw new RouterNotFoundException(sprintf('%s Not Found.', $name));
        }
        /* @var ControllerInterface $handel */
        return $this->routerMap[$name];
    }
}
