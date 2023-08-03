<?php

declare(strict_types=1);

namespace Domain\Project\Action;

use Domain\Project\DTO\UpdateProjectData;
use Domain\Project\Models\Project;
use Domain\User\DTO\CreateUserData;
use Domain\User\DTO\UpdateUserData;
use Domain\User\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateProjectAction
{
    public function __invoke(Project $project, UpdateProjectData $data): Project
    {
        $updateData = [
            'name' => $data->name ?? $project->name,
            'description' => $data->description ?? $project->description,
            'is_private' => $data->is_private ?? $project->is_private,
        ];

        $project->update($updateData);

        return $project->fresh();
    }
}
