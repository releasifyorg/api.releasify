<?php

declare(strict_types=1);

namespace Domain\Team\Actions;

use Domain\Team\Models\Invite;
use Domain\User\Models\User;
use Illuminate\Support\Facades\DB;

class AcceptInviteAction
{
    public function __invoke(Invite $invite, User $user)
    {
        try {
            DB::beginTransaction();

            $invite->update([
                'accepted_at' => now(),
            ]);

            $team = $invite->team;

            $team->users()->attach($user->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
