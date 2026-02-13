<?php

namespace Modules\Base\Traits;

use Modules\Base\Contracts\CacheInterface;

trait Cacheable
{
    protected function cache(string $key, int $ttl, \Closure $callback)
    {
        return app(CacheInterface::class)
            ->remember($key, $ttl, $callback);
    }
}
