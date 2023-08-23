<?php

declare(strict_types=1);

namespace Domain\Team\DTO;

use Domain\Team\Requests\CreateTeamRequest;
use Spatie\LaravelData\Data;

class CreateTeamData extends Data
{
    public function __construct(
        public string $name,
        public int $user_id,
    ) {
    }

    public static function fromRequest(CreateTeamRequest $request) {
        return new self(
            $request->name,
            $request->user()->id,
        );
    }
}
