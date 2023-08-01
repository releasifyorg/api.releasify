<?php

declare(strict_types=1);

use Domain\User\Controllers\GithubCallbackController;
use Domain\User\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::post('github/auth', GithubCallbackController::class);
Route::post('register', RegistrationController::class);
