<?php

declare(strict_types=1);

use Domain\Project\Controllers\CreateProjectController;
use Domain\Project\Controllers\GetProjectsController;
use Domain\Project\Controllers\ProjectController;
use Domain\Project\Controllers\ProjectDeleteController;
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

Route::group([

    'namespace' => '\Domain\Project\Controllers',
    'prefix' => 'projects',

], function () {

    Route::get('/', GetProjectsController::class);
    Route::get('/{project}', ProjectController::class);
    Route::post('/', CreateProjectController::class);
    Route::delete('/{project}', ProjectDeleteController::class);
    Route::put('/{project}');

});
