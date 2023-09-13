<?php

declare(strict_types=1);

namespace Domain\Project\Action;

use Domain\Project\DTO\ProjectGithubConnectData;
use Domain\Project\Models\Project;

class ProjectGithubConnectAction
{
    public function __invoke(ProjectGithubConnectData $data, Project $project): Project
    {
        $updateData = [
            'github_repo_id' => $data->github_repo_id,
        ];

        $project->update($updateData);

        return $project->fresh();
    }
}
