<?php

use Dionisvl\FrontParts\Http\Controllers\Admin\FrontPartsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin']], function () {
    Route::resource('/frontparts', FrontPartsController::class)
        ->except(['show']);
});
