<?php

namespace App\Policies;

use Domain\Project\Models\Project;
use Domain\User\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        return !$project->is_private
            || $project->user_id == $user->id
            || $user->teams()->where('team_id', $project->team_id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        return $project->user_id == $user->id
            || $user->teams()->where('team_id', $project->team_id)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        return $project->user_id == $user->id
            || $user->teams()->where('team_id', $project->team_id)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        //
    }

    public function commit(User $user, Project $project): bool
    {
        return $project->user_id == $user->id
            || $user->teams()->where('team_id', $project->team_id)->exists();
    }
}
