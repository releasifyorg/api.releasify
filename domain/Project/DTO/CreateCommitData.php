<?php

declare(strict_types=1);

namespace Domain\Project\DTO;

use Domain\Project\Models\Project;
use Domain\Project\Requests\CreateCommitRequest;
use Spatie\LaravelData\Data;

class CreateCommitData extends Data
{
    public function __construct(
        public string $name,
        public ?string $body,
        public bool $prerelease,
        public bool $make_latest,
        public string $tag_name,
        public int $user_id,
        public int $project_id,
    ) {
    }

    public static function fromObjects(CreateCommitRequest $request, Project $project) {
        return new self(
            $request->name,
            $request->body,
            $request->prerelease,
            $request->make_latest,
            $request->tag_name,
            $request->user()->id,
            $project->id
        );
    }
}
