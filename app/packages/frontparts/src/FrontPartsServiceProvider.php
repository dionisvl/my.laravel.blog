<?php

namespace Dionisvl\FrontParts;

use Illuminate\Support\ServiceProvider;


class FrontPartsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            $this->packageDir() . '/src/config/frontparts.php',
            'frontparts'
        );
    }

    protected function packageDir(): string
    {
        return dirname(__DIR__) . '/';
    }

    public function boot(): void
    {
        $this->loadRoutesFrom($this->packageDir() . '/routes.php');
        $this->loadViewsFrom($this->packageDir() . '/src/resources/views', 'frontparts');
        $this->loadFactoriesFrom(__DIR__ . '/database/factories');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    private function registerSettings(): void
    {

    }
}
