<?php

declare(strict_types=1);

namespace Domain\Project\Action;

use Domain\Project\Models\Project;
use Domain\User\DTO\CreateUserData;
use Domain\User\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeleteProjectAction
{
    public function __invoke(Project $project): bool
    {
        try {
            $project->delete();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
