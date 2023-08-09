<?php

declare(strict_types=1);

use Domain\User\Controllers\GithubCallbackController;
use Domain\User\Controllers\LoginController;
use Domain\User\Controllers\RegistrationController;
use Domain\User\Controllers\ResetPasswordByTokenController;
use Domain\User\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::post('github/auth', GithubCallbackController::class);
Route::post('register', RegistrationController::class);
Route::post('login', LoginController::class);

Route::prefix('password')->group(function() {
    Route::post('forgot', ResetPasswordController::class);
    Route::post('reset', ResetPasswordByTokenController::class);
});

