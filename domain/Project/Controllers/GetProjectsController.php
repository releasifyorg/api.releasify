<?php

declare(strict_types=1);

namespace Domain\Project\Controllers;

use App\Support\Parents\ParentController;
use Domain\Project\Action\CreateProjectAction;
use Domain\Project\DTO\CreateProjectData;
use Domain\Project\Requests\CreateProjectRequest;
use Domain\User\Actions\CreateUserAction;
use Domain\User\DTO\CreateUserData;
use Illuminate\Http\Request;

class GetProjectsController extends ParentController
{
    public function __invoke(Request $request)
    {
        try {
            return $request->user()->projects;
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
