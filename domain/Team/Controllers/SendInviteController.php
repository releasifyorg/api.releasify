<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Actions\SendInviteAction;
use Domain\Team\DTO\SendInviteData;
use Domain\Team\Models\Team;
use Domain\Team\Requests\InviteRequest;
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
            $this->authorize('invite', $team);

            $this->isMember($team, $user);
            $this->isInvited($team, $user);

            $inviteData = SendInviteData::fromObjects($team, $user);

            $invite = ($this->sendInviteAction)($inviteData);

            return $invite;
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws \Exception
     */
    public function isMember(Team $team, User $user) {
        if ($team->users()->get()->contains($user)) {
            throw new \Exception('User already in the team.',  422);
        }
    }

    /**
     * @throws \Exception
     */
    public function isInvited(Team $team, User $user) {
        if ($team->invites()->where('email', $user->email)
            ->where('team_id', $team->id)
            ->exists()) {
            throw new \Exception('User already invited.',  422);
        }
    }
}
