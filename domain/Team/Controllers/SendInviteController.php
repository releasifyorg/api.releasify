<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Actions\SendInviteAction;
use Domain\Team\DTO\SendInviteData;
use Domain\Team\Models\Team;
use Domain\Team\Resources\InviteResource;
use Domain\User\Models\User;
use Illuminate\Http\Request;

class SendInviteController extends ParentController
{
    public function __construct(
        private readonly SendInviteAction $sendInviteAction,
    ) {
    }

    public function __invoke(Request $request, Team $team, User $user)
    {
        try {
            $inviteData = SendInviteData::fromObjects($team, $user);

            $invite = ($this->sendInviteAction)($inviteData, $team);

            return $this->success(
                new InviteResource($invite)
            );
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
