<?php

declare(strict_types=1);

namespace Domain\Project\Controllers;

use App\Support\Parents\ParentController;
use Domain\Project\Action\CreateProjectAction;
use Domain\Project\DTO\CreateProjectData;
use Domain\Project\Requests\CreateProjectRequest;
use Domain\User\Actions\CreateUserAction;
use Domain\User\DTO\CreateUserData;

class CreateProjectController extends ParentController
{
    public function __construct(
        private readonly CreateProjectAction $createProjectAction
    ) {
    }

    public function __invoke(CreateProjectRequest $request)
    {
        try {
            $projectData = CreateProjectData::fromRequest($request);

            $project = ($this->createProjectAction)($projectData);

            return $this->success($project);

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
