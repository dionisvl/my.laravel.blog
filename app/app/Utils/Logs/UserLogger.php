<?php

namespace App\Utils\Logs;

use Illuminate\Support\Carbon;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class UserLogger
{
    /**
     * Create a custom Monolog instance and pipe logs to the tenant directory.
     *
     * @param array $config
     * @return Logger
     */
    public function __invoke(array $config): Logger
    {
        $log = new Logger($config['logname']);
        $level = $log::toMonologLevel($config['level'] ?: 'debug');

        $currUserId = auth()->user()->id;

        $logPath = storage_path('logs/by_user/' . $currUserId . '/' . Carbon::now()->toDateString() . '.log');
        $log->pushHandler(new StreamHandler($logPath, $level, false));

        return $log;
    }
}
