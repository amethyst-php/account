<?php

namespace Railken\LaraOre;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Railken\LaraOre\Api\Support\Router;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ore.account.php' => config_path('ore.account.php'),
        ], 'config');
        $this->loadRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ApiServiceProvider::class);
        $this->app->register(\Railken\LaraOre\UserServiceProvider::class);
        $this->app->register(\Railken\LaraOre\AuthServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.account.php', 'ore.account');
    }

    /**
     * Load routes.
     */
    public function loadRoutes()
    {
        Router::group(Config::get('ore.account.http.router'), function ($router) {
            $controller = Config::get('ore.account.http.controller');
            $router->get('/', ['uses' => $controller.'@index']);
        });
    }
}
