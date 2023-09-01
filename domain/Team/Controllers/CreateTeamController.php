<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Actions\CreateTeamAction;
use Domain\Team\DTO\CreateTeamData;
use Domain\Team\Requests\CreateTeamRequest;
use Domain\Team\Resources\TeamResource;

class CreateTeamController extends ParentController
{
    public function __construct(
        private readonly CreateTeamAction $createTeamAction
    ) {
    }

    public function __invoke(CreateTeamRequest $request)
    {
        try {
            $teamData = CreateTeamData::fromRequest($request);

            $team = ($this->createTeamAction)($teamData);

            return $this->success(new TeamResource($team));
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
