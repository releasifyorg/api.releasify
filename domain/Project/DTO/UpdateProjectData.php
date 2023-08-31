<?php

declare(strict_types=1);

namespace Domain\Project\DTO;

use Domain\Project\Requests\ProjectUpdateRequest;
use Spatie\LaravelData\Data;

class UpdateProjectData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description,
        public bool $is_private,
    ) {
    }



    public static function fromRequest(ProjectUpdateRequest $request) {
        return new self(
            $request->name,
            $request->description,
            $request->is_private,
        );
    }
}
