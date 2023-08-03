<?php

declare(strict_types=1);

namespace Domain\Project\Controllers;

use App\Support\Parents\ParentController;
use Domain\Project\Action\UpdateProjectAction;
use Domain\Project\DTO\UpdateProjectData;
use Domain\Project\Models\Project;
use Domain\Project\Requests\ProjectUpdateRequest;
use Domain\User\Actions\DeleteUserAction;
use Domain\User\Actions\UpdateUserAction;
use Domain\User\DTO\UpdateUserData;
use Domain\User\Models\User;
use Domain\User\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class ProjectUpdateController extends ParentController
{
    public function __construct(
        private readonly UpdateProjectAction $updateProjectAction,
    ) {
    }

    public function __invoke(ProjectUpdateRequest $request, Project $project)
    {
        try {
            $this->authorize('update', $project);

            $projectData = UpdateProjectData::fromRequest($request);

            $updatedProject = ($this->updateProjectAction)($project, $projectData);

            return $this->success($updatedProject);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
