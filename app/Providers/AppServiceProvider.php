<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Modules\User\UserServiceProvider;


class AppServiceProvider extends ServiceProvider
{

    public const MODULES_SERVICE_PROVIDERS = [

        UserServiceProvider::class,
        BroadcastServiceProvider::class,
    ];

    public function register(): void
    {
        foreach (self::MODULES_SERVICE_PROVIDERS as $serviceProvider) {
            $this->app->register($serviceProvider);
        }
    }


    public function boot(): void
    {
        RateLimiter::for('api', static function (Request $request) {
            return Limit::perMinute(30)->by($request->user()?->id ?: $request->ip());
        });

        Paginator::useBootstrapFive();

        \Vite::useBuildDirectory('');
    }
}
