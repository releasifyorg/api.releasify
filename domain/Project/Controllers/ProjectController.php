<?php

declare(strict_types=1);

namespace Domain\Project\Controllers;

use App\Support\Parents\ParentController;
use Domain\Project\Action\CreateProjectAction;
use Domain\Project\DTO\CreateProjectData;
use Domain\Project\Models\Project;
use Domain\Project\Requests\CreateProjectRequest;
use Domain\Project\Resources\ProjectResource;
use Domain\User\Actions\CreateUserAction;
use Domain\User\DTO\CreateUserData;
use Illuminate\Http\Request;

class ProjectController extends ParentController
{
    public function __invoke(Request $request, Project $project)
    {
        try {
            return new ProjectResource($project);
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
