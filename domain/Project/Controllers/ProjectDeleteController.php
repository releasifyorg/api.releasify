<?php

declare(strict_types=1);

namespace Domain\Project\Controllers;

use App\Support\Parents\ParentController;
use Domain\Project\Action\DeleteProjectAction;
use Domain\Project\Models\Project;
use Domain\User\Actions\DeleteUserAction;
use Domain\User\Models\User;
use Illuminate\Http\Request;

class ProjectDeleteController extends ParentController
{
    public function __construct(
        private readonly DeleteProjectAction $deleteProjectAction
    ) {
    }

    public function __invoke(Request $request, Project $project)
    {
        try {
            $this->authorize('delete', $project);

            $isDeleted = ($this->deleteProjectAction)($project);

            if (!$isDeleted) {
                return $this->error([], 'Database deleting error');
            }

            return $this->noContent();
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
