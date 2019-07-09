<?php

namespace Amethyst\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Amethyst\Api\Support\Router;
use Amethyst\Common\CommonServiceProvider;

class AccountServiceProvider extends CommonServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
        $this->app->register(\Amethyst\Providers\ApiServiceProvider::class);
        $this->app->register(\Amethyst\Providers\UserServiceProvider::class);
        $this->app->register(\Amethyst\Providers\AuthenticationServiceProvider::class);

        parent::register();
    }

    /**
     * Load routes.
     */
    public function loadRoutes()
    {
        $config = Config::get('amethyst.account.http.app.account');

        Router::group('app', Arr::get($config, 'router'), function ($router) use ($config) {
            $controller = Arr::get($config, 'controller');
            $router->get('/', ['as' => 'show', 'uses' => $controller.'@index']);
        });
    }
}
