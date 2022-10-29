<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Lib\Middleware;

use KLog\Annotation\Log;
use KLog\Lib\Logger\LoggerInterface;
use KLog\Lib\Router\Router;
use ReflectionClass;

class Middleware
{
    protected LoggerInterface $logger;

    protected Router $router;

    public function __construct(LoggerInterface $logger, Router $router)
    {
        $this->router = $router;
        $this->logger = $logger;
    }

    public function handle(string $action, $request)
    {
        $controller = $this->router->handle($action);
        $methodMapAnnotation = $this->getClassAppointAnnotationMethod($controller::class);
        $data = $controller->index();
        if (in_array($controller::class, $methodMapAnnotation)) {
            $this->logger->info([
                'request' => $request,
                'response' => $data,
            ]);
        }
        return $data;
    }

    /**
     * 获取某个类下有指定注解的方法.
     *
     * @param array $methodMapAnnotation
     */
    protected function getClassAppointAnnotationMethod(string $className): array
    {
        $methodMapAnnotation = [];

        $rc = new ReflectionClass($className);
        $methods = $rc->getMethods();
        foreach ($methods as $k => $v) {
            foreach ($v->getAttributes(Log::class) as $kk => $vv) {
                $methodMapAnnotation[$className] = $className;
            }
        }
        return $methodMapAnnotation;
    }
}
