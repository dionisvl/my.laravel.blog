<?php

use Dionisvl\Chat\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'chat', 'middleware' => ['web']],
    static function () {
        Route::get('/start', [\Dionisvl\Chat\Http\Controllers\ChatController::class, 'start'])
            ->name('chat.start');
    }
);

Route::get('/chat/test', [ChatController::class, 'testView']);
