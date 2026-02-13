<?php

namespace Modules\Base\Contracts;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
class CacheManager
{

    public function __construct(protected CacheRepository $cache){}

    public  function  remember(string $key , int $ttl , callable $callback , ?string $tag = null)
    {
        if ($tag && $this->supportsTags()){
            return $this->cache->tags([$tag])->remember($key , $ttl , $callback);
        }
        return $this->cache->remember($key , $ttl,$callback);
    }
    public function flush(?string $tag = null ,?string $key = null):void
    {
        if ($tag && $this->supportsTags()){
            $this->cache->tags([$tag])->flush();
        return;
        }
        if ($key !== null) {
            $this->cache->forget($key);
        }
    }

    protected function supportsTags(): bool
    {
        return method_exists($this->cache->getStore(), 'tags');
    }
}
