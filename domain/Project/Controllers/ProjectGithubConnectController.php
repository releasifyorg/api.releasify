<?php

declare(strict_types=1);

namespace Domain\Project\Controllers;

use App\Support\Parents\ParentController;
use Domain\Project\Action\CreateCommitAction;
use Domain\Project\Action\CreateProjectAction;
use Domain\Project\Action\ProjectGithubConnectAction;
use Domain\Project\DTO\CreateProjectData;
use Domain\Project\DTO\ProjectGithubConnectData;
use Domain\Project\Models\Project;
use Domain\Project\Requests\CreateProjectRequest;
use Domain\Project\Requests\ProjectGithubConnectRequest;
use Domain\Project\Resources\ProjectResource;
use Domain\User\Actions\CreateUserAction;
use Domain\User\DTO\CreateUserData;
use Illuminate\Http\Request;

class ProjectGithubConnectController extends ParentController
{
    public function __construct(
        private readonly ProjectGithubConnectAction $projectGithubConnectAction
    ) {
    }

    public function __invoke(ProjectGithubConnectRequest $request, Project $project)
    {
        try {
            $projectData = ProjectGithubConnectData::fromRequest($request);

            $project = ($this->projectGithubConnectAction)($projectData, $project);

            return new ProjectResource($project);
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
