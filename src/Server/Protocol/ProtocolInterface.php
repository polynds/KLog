<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace KLog\Server\Protocol;

interface ProtocolInterface
{
    public function encode();

    public function decode($data): self;
}
