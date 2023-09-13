<?php

declare(strict_types=1);

namespace Domain\Project\DTO;

use Domain\Project\Models\Project;
use Domain\Project\Requests\CreateCommitRequest;
use Domain\Project\Requests\ProjectGithubConnectRequest;
use Spatie\LaravelData\Data;

class ProjectGithubConnectData extends Data
{
    public function __construct(
        public int $github_repo_id,
    ) {
    }

    public static function fromRequest(ProjectGithubConnectRequest $request) {
        return new self(
            $request->github_repo_id,
        );
    }
}
