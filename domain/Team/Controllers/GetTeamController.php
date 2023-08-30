<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Project\Action\CreateProjectAction;
use Domain\Project\DTO\CreateProjectData;
use Domain\Project\Models\Project;
use Domain\Project\Requests\CreateProjectRequest;
use Domain\Team\Models\Team;
use Domain\User\Actions\CreateUserAction;
use Domain\User\DTO\CreateUserData;
use Illuminate\Http\Request;

class GetTeamController extends ParentController
{
    public function __invoke(Request $request, Team $team)
    {
        try {
            $team->load('users');

            return $team;
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
