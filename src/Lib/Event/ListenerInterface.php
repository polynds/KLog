<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Lib\Event;

interface ListenerInterface
{
    public function listen(): array;

    public function process(object $event);
}
