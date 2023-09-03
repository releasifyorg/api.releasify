<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Actions\DeleteTeamAction;
use Domain\Team\Models\Team;
use Domain\User\Models\User;
use Illuminate\Http\Request;

class  RemoveMemberController extends ParentController
{
    public function __invoke(Request $request, Team $team, User $user)
    {
        try {
            $team->users()->detach($user);

            return $this->noContent();
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
