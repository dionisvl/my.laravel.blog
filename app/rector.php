<?php

// rector.php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use RectorLaravel\Set\LaravelLevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([
        SetList::PHP_82,
        LaravelLevelSetList::UP_TO_LARAVEL_100
    ]);

    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/database',
        __DIR__ . '/config',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
    ]);

    // Specify any custom configurations or skip rules if needed
};
