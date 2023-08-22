<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\ProjectPolicy;
use App\Policies\TeamPolicy;
use Domain\Project\Models\Project;
use Domain\Team\Models\Team;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
