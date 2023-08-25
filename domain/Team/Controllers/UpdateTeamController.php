<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Actions\UpdateTeamAction;
use Domain\Team\DTO\UpdateTeamData;
use Domain\Team\Models\Team;
use Domain\Team\Requests\UpdateTeamRequest;

class UpdateTeamController extends ParentController
{
    public function __construct(
        private readonly UpdateTeamAction $updateTeamAction,
    ) {
    }

    public function __invoke(UpdateTeamRequest $request, Team $team)
    {
        try {
            $this->authorize('update', $team);

            $teamData = UpdateTeamData::fromRequest($request);

            $updatedTeam = ($this->updateTeamAction)($team, $teamData);

            return $this->success($updatedTeam);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
