<?php

namespace Modules\Base;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class BaseServiceProvider extends  ServiceProvider
{
 protected $namespace = 'Modules/Base/Controllers';
    public function boot()
    {

    }
    public function register(): void
    {
        parent::register();
    }
}
