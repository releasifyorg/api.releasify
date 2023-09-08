<?php

declare(strict_types=1);

namespace Domain\Project\Action;

use Domain\Project\DTO\CreateCommitData;
use Domain\Project\Models\Commit;

class CreateCommitAction
{
    public function __invoke(CreateCommitData $data): Commit
    {
        return Commit::create([
            'name' => $data->name,
            'body' => $data->body,
            'prerelease' => $data->prerelease,
            'make_latest' => $data->make_latest,
            'tag_name' => $data->tag_name,
            'user_id' => $data->user_id,
            'project_id' => $data->project_id,
        ]);
        // TODO: Github sync
    }
}
