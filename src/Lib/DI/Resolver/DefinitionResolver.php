<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Lib\DI\Resolver;

interface DefinitionResolver
{
    public function resolve(string $className);
}
