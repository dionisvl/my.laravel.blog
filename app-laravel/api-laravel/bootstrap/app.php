<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: *');
//header('Access-Control-Allow-Headers: *');

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/** Use storage path from parent catalog (for CI/CD) */
if (!function_exists('locateBasePath')) {
    /**
     * @param $app
     * @return string
     */
    function locateBasePath($app): string
    {
        // Этот путь содержит зависимую от версии часть пути, поэтому запущенные процессы не найдут после апдейта такой путь
        // возможно разумным вариантом было бы dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'storage'
        $underBuild = realpath($app->basePath().DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'storage');
        $inBuild = realpath($app->basePath().DIRECTORY_SEPARATOR.'storage');

        if ($underBuild !== false && is_dir($underBuild)) {
            return $underBuild;
        }

        if ($inBuild !== false) {
            return $inBuild;
        }

        // Fallback to default storage path
        return $app->basePath() . DIRECTORY_SEPARATOR . 'storage';
    }
}
$app->useStoragePath(locateBasePath($app));
/** end */

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
