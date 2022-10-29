<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Server;

use KLog\Lib\Config\ConfigInterface;
use KLog\Lib\Event\EventDispatcher;
use KLog\Lib\Logger\LoggerInterface;
use KLog\Lib\Router\Router;
use KLog\Server\Event\ServerStartEvent;
use KLog\Server\Event\ServerStopEvent;
use KLog\Utils\Json;
use Swoole\Coroutine;
use Swoole\Coroutine\Http\Server as SwooleServer;
use Swoole\Http\Request;
use Swoole\Http\Response;

class Server
{
    protected LoggerInterface $logger;

    protected ConfigInterface $config;

    protected ServerConfig $serverConfig;

    protected SwooleServer $httpServer;

    protected EventDispatcher $eventDispatcher;

    protected Router $router;

    public function __construct(ConfigInterface $config, EventDispatcher $eventDispatcher, LoggerInterface $logger, Router $router)
    {
        $this->router = $router;
        $this->config = $config;
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
        $this->serverConfig = new ServerConfig($this->config->get('server'));
    }

    public function start()
    {
        $this->initServer();
        Coroutine::create(function () {
            $this->eventDispatcher->dispatch(new ServerStartEvent($this->httpServer, $this->serverConfig));
            $this->httpServer->start();
            $this->eventDispatcher->dispatch(new ServerStopEvent($this->httpServer));
        });
    }

    protected function initServer()
    {
        $this->httpServer = new SwooleServer($this->serverConfig->getHost(), $this->serverConfig->getPort());
        $this->handleHttp();
    }

    protected function handleHttp()
    {
        $this->httpServer->handle('/', function (Request $request, Response $response) {
            if (! $request->server['request_uri']) {
                $response->end('Controller not found!');
                return;
            }
            $action = $request->server['request_uri'];
            if ($action == '/favicon.ico') {
                $response->end('');
                return;
            }
            $data = $this->router->handel($action);
            $this->logger->info($data);
            $response->end(Json::encode($data));
        });
    }
}
