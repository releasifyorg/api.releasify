<?php

declare(strict_types=1);

namespace Domain\Team\DTO;

use Domain\Team\Models\Team;
use Domain\Team\Requests\InviteRequest;
use Domain\User\Models\User;
use Spatie\LaravelData\Data;

class SendInviteData extends Data
{
    public function __construct(
        public string $email,
        public int $team_id,
    ) {
    }

    public static function fromObjects(Team $team, User $user) {
        return new self(
            $user->email,
            $team->id,
        );
    }
}
