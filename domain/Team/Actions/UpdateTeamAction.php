<?php

declare(strict_types=1);

namespace Domain\Team\Actions;

use Domain\Team\DTO\UpdateTeamData;
use Domain\Team\Models\Team;

class UpdateTeamAction
{
    public function __invoke(Team $team, UpdateTeamData $data): Team
    {
        $updateData = [
            'name' => $data->name,
            'user_id' => $data->user_id,
        ];

        $team->update($updateData);

        return $team->fresh();
    }
}
