<?php

namespace Dionisvl\Shop;

use Dionisvl\Shop\Models\Order;
use Illuminate\Support\ServiceProvider;


class ShopServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            $this->packageDir() . '/src/config/shop.php',
            'shop'
        );
    }

    protected function packageDir()
    {
        return realpath(__DIR__ . '/../');
    }

    public function boot()
    {
        $this->loadRoutesFrom($this->packageDir() . '/routes.php');
        $this->loadViewsFrom($this->packageDir() . '/src/resources/views', 'shop');
        $this->loadFactoriesFrom(__DIR__ . '/database/factories');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        view()->composer('admin._sidebar', function ($view) {
            $view->with([
                'newOrdersCount' => Order::where('status', 0)->count()
            ]);
        });
    }

    private function registerSettings()
    {

    }
}
