<?php

namespace Dionisvl\Shop;

use App\Models\Category;
use Dionisvl\Shop\Models\Order;
use Illuminate\Support\ServiceProvider;


class ShopServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            $this->packageDir() . '/src/config/shop.php',
            'shop'
        );
    }

    protected function packageDir(): string
    {
        return dirname(__DIR__) . '/';
    }

    public function boot(): void
    {
        $this->loadRoutesFrom($this->packageDir() . '/routes.php');
        $this->loadViewsFrom($this->packageDir() . '/src/resources/views', 'shop');
        $this->loadFactoriesFrom(__DIR__ . '/database/factories');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        view()->composer('admin._sidebar', static function ($view) {
            $view->with([
                'newOrdersCount' => Order::where('status', 0)->count()
            ]);
        });

        view()->composer('shop::shop.layout', static function ($view) {
            $categories = Category::orderBy('title', 'asc')->get();
            $view->with('categories', $categories);
        });
    }

    private function registerSettings(): void
    {

    }
}
