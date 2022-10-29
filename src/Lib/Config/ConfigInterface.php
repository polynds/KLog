<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Lib\Config;

interface ConfigInterface
{
    public function get(string $key);
}
