<?php

namespace Modules\Base;

use Modules\Base\Contracts\CacheService;
use Modules\Base\Contracts\CacheInterface;

class CacheServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CacheInterface::class,
            CacheService::class
        );
    }

}
