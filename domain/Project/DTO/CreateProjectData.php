<?php

declare(strict_types=1);

namespace Domain\Project\DTO;

use Domain\Project\Models\Project;
use Domain\Project\Requests\CreateProjectRequest;
use Domain\User\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelData\Data;

class CreateProjectData extends Data
{
    public function __construct(
        public string $name,
        public ?string $description,
        public bool $is_private,
        public int $user_id,
    ) {
    }



    public static function fromRequest(CreateProjectRequest $request) {
        return new self(
            $request->name,
            $request->description,
            $request->is_private,
            $request->user()->id,
        );
    }
}
