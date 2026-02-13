<?php

namespace Modules\Base\Contracts;

use Illuminate\Support\Facades\Cache;

class CacheService implements CacheInterface
{
    public function get(string $key, mixed $default = null): mixed
    {
        return Cache::get($key, $default);
    }

    public function put(string $key, mixed $value, int $ttl = null): bool
    {
        return Cache::put($key, $value, $ttl);
    }

    public function remember(string $key, int $ttl, \Closure $callback): mixed
    {
        return Cache::remember($key, $ttl, $callback);
    }

    public function forget(string $key): bool
    {
        return Cache::forget($key);
    }
}
