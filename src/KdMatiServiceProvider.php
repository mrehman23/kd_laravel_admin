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
        $this->publishes([__DIR__.'/publish' => public_path('vendor/kdladmin')], 'public');
        $this->publishes([__DIR__.'/views/layouts' => 'resources/views/layouts'], 'public');
        // $this->app['router']->middleware('kdverifyroutes', 'Kd\Kdladmin\Middleware\KdVerifyRoutesMiddleware');
        $this->app['router']->pushMiddlewareToGroup('web', Kd\Kdladmin\Middleware\KdVerifyRoutesMiddleware::class);
        // $this->loadMiddlewareGroupsFrom('web', ['']);
        // $this->app->middleware([
        //        // \Vendor\Package\Middleware\TestMiddleware::class
        //     \Kd\Kdladmin\Middleware\KdVerifyRoutesMiddleware
        // ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->make('Kd\Kdladmin\Controllers\UserController');        
    }
}