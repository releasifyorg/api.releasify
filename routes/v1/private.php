<?php

declare(strict_types=1);

use Domain\User\Controllers\ProfileController;
use Domain\User\Controllers\ProfileDeleteController;
use Domain\User\Controllers\ProfileUpdateController;
use Illuminate\Support\Facades\Route;

Route::group([

    'namespace' => '\Domain\User\Controllers',
    'prefix' => 'profile',

], function () {

    Route::get('/', ProfileController::class);
    Route::put('/', ProfileUpdateController::class);
    Route::delete('/', ProfileDeleteController::class);

});
