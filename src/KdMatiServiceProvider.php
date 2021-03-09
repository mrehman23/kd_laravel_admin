<?php

namespace Kd\Kdladmin;

use Illuminate\Support\ServiceProvider;

class KdMatiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'kd');
        $this->publishes([__DIR__.'/publish' => public_path('vendor/kdladmin')], 'kdpublic');
        $this->publishes([__DIR__.'/views/layouts' => 'resources/views/layouts'], 'kdpublic');
        $this->app['router']->pushMiddlewareToGroup('web', Middleware\KdVerifyRoutesMiddleware::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}