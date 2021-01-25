<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'chat', 'middleware' => ['web']], function () {
    Route::get('/start', [\Dionisvl\Chat\Http\Controllers\ChatController::class, 'start'])
        ->name('chat.start');
});
