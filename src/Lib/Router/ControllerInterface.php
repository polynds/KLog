<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace KLog\Lib\Router;

use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface
{
    public function index(ServerRequestInterface $request): array;
}
