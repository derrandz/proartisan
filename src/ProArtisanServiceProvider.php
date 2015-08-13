<?php

namespace Hamzaouaghad\Proartisan;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ProArtisanServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'proartisan');
        
        $this->setupRoutes($this->app->router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Hamzaouaghad\ProArtisan\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/vendor/'),
        ]);
    }

}