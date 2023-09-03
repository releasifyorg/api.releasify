<?php

declare(strict_types=1);

use Domain\Github\Controllers\GetReposController;
use Domain\Project\Controllers\CreateProjectController;
use Domain\Project\Controllers\GetProjectsController;
use Domain\Project\Controllers\ProjectController;
use Domain\Project\Controllers\ProjectDeleteController;
use Domain\Project\Controllers\ProjectUpdateController;
use Domain\Team\Controllers\CreateTeamController;
use Domain\Team\Controllers\RemoveMemberController;
use Domain\Team\Controllers\DeleteTeamController;
use Domain\Team\Controllers\GetInvitesController;
use Domain\Team\Controllers\GetTeamController;
use Domain\Team\Controllers\GetTeamsController;
use Domain\Team\Controllers\SendInviteController;
use Domain\Team\Controllers\UpdateTeamController;
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

    Route::group([

        'namespace' => '\Domain\Github\Controllers',
        'prefix' => 'github',
        'middleware' => 'github.auth',

    ], function () {

        Route::get('/repos', GetReposController::class);

    });

});

Route::group([

    'namespace' => '\Domain\Project\Controllers',
    'prefix' => 'projects',

], function () {

    Route::get('/', GetProjectsController::class);
    Route::get('/{project}', ProjectController::class)
        ->can('view', 'project');
    Route::post('/', CreateProjectController::class);
    Route::delete('/{project}', ProjectDeleteController::class)
        ->can('delete', 'project');
    Route::put('/{project}', ProjectUpdateController::class)
        ->can('update', 'project');

});

Route::group([

    'namespace' => '\Domain\Team\Controllers',
    'prefix' => 'teams',

], function () {

    Route::get('/', GetTeamsController::class);
    Route::get('/invites', GetInvitesController::class);
    Route::get('/{team}', GetTeamController::class)
        ->can('view', 'team');
    Route::post('/{team}/invite/{user}', SendInviteController::class)
        ->can('invite', ['team', 'user']);
    Route::post('/', CreateTeamController::class);
    Route::delete('/{team}', DeleteTeamController::class)
        ->can('delete', 'team');
    Route::delete('/{team}/remove/{user}', RemoveMemberController::class)
        ->can('removeMember', ['team', 'user']);
    Route::put('/{team}', UpdateTeamController::class)
        ->can('update', 'team');

});
