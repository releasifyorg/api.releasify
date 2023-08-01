<?php

declare(strict_types=1);

use Domain\User\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('profile', ProfileController::class);
