<?php

declare(strict_types=1);

use Domain\User\Controllers\GithubCallbackController;
use Illuminate\Support\Facades\Route;

Route::post('github/auth', GithubCallbackController::class);
