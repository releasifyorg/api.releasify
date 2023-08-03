<?php

declare(strict_types=1);

namespace Domain\Project\Action;

use Domain\Project\DTO\CreateProjectData;
use Domain\Project\Models\Project;

class CreateProjectAction
{
    public function __invoke(CreateProjectData $data): Project
    {
        return Project::create([
            'name' => $data->name,
            'description' => $data->description,
            'is_private' => $data->is_private,
            'user_id' => $data->user_id,
        ]);
    }
}
