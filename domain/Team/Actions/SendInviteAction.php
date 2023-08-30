<?php

declare(strict_types=1);

namespace Domain\Team\Actions;

use Domain\Team\DTO\SendInviteData;
use Domain\Team\Models\Invite;
use Domain\Team\Models\Team;

class SendInviteAction
{
    public function __invoke(SendInviteData $data, Team $team): Invite
    {
        $invite = $team->invites()->create([
            'sender_id' => auth()->id(),
            'email' => $data->email,
        ]);

        return $invite;
    }
}
