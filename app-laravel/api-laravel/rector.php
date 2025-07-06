<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use RectorLaravel\Set\LaravelLevelSetList;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([
        SetList::PHP_82,
        LevelSetList::UP_TO_PHP_82,
        LaravelLevelSetList::UP_TO_LARAVEL_110
    ]);

    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/database',
        __DIR__ . '/config',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

    // Skip problematic rules
    $rectorConfig->skip([
        // Skip specific paths if needed
        __DIR__ . '/vendor',
        __DIR__ . '/storage',
        __DIR__ . '/bootstrap/cache',
    ]);

    // Import names for better readability
    $rectorConfig->importNames();
    $rectorConfig->importShortClasses();
};
