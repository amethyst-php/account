<?php

namespace Railken\LaraOre;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Railken\LaraOre\Api\Support\Router;

class AccountServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
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
     */
    public function register()
    {
        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ApiServiceProvider::class);
        $this->app->register(\Railken\LaraOre\UserServiceProvider::class);
        $this->app->register(\Railken\LaraOre\AuthenticationServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.account.php', 'ore.account');
    }

    /**
     * Load routes.
     */
    public function loadRoutes()
    {
        $config = Config::get('ore.account.http.app');

        Router::group('app', Arr::get($config, 'router'), function ($router) use ($config) {
            $controller = Arr::get($config, 'controller');
            $router->get('/', ['uses' => $controller.'@index']);
        });
    }
}
