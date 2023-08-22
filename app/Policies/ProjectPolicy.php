<?php

namespace App\Policies;

use App\Project;
use Domain\Project\Models\Project as DbProject;
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
    public function view(User $user, DbProject $project): bool
    {
        return !$project->is_private
            || $project->user_id == $user->id
            || $user->teams()->wherePivot('is_active', true)->where('team_id', $project->team_id)->exists();
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
    public function update(User $user, DbProject $project): bool
    {
        return $project->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DbProject $project): bool
    {
        return $project->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DbProject $project): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DbProject $project): bool
    {
        //
    }
}
