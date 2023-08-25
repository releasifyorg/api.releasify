<?php

declare(strict_types=1);

namespace Domain\Team\DTO;

use Domain\Team\Requests\UpdateTeamRequest;
use Spatie\LaravelData\Data;

class UpdateTeamData extends Data
{
    public function __construct(
        public string $name,
        public int $user_id,
    ) {
    }

    public static function fromRequest(UpdateTeamRequest $request) {
        return new self(
            $request->name,
            $request->user_id,
        );
    }
}
