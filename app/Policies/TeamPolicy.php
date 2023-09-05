<?php

namespace App\Policies;

use Domain\Team\Models\Invite;
use Domain\Team\Models\Team;
use Domain\User\Models\User;
use Illuminate\Auth\Access\Response;

class TeamPolicy
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
    public function view(User $user, Team $team): bool
    {
        return $team->hasUser($user);
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
    public function update(User $user, Team $team): bool
    {
        return $team->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $team->user_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        //
    }

    public function invite(User $user, Team $team, User $invitedUser): bool
    {
        return $team->user_id == $user->id
            && !$team->hasUser($invitedUser)
            && !$team->invites()->where('email', $invitedUser->email)
                ->where('team_id', $team->id)
                ->whereNull('accepted_at')
                ->exists();
    }

    public function removeMember(User $user, Team $team, User $userToRemove): bool
    {
        return $team->user_id == $user->id
            && $team->hasUser($userToRemove);
    }

    public function inviteDeny(User $user, Invite $invite): bool
    {
        return $user->hasInvite($invite)
            && !$invite->accepted_at;
    }
}
