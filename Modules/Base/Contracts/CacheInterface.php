<?php

namespace Modules\Base\Contracts;

interface CacheInterface
{
    public function get(string $key, mixed $default = null): mixed;

    public function put(string $key, mixed $value, int $ttl = null): bool;

    public function remember(string $key, int $ttl, \Closure $callback): mixed;

    public function forget(string $key): bool;
}
