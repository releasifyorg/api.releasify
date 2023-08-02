<?php

declare(strict_types=1);

namespace Domain\User\DTO;

use Domain\User\Requests\RegistrationRequest;
use Spatie\LaravelData\Data;

class CreateUserData extends Data
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
    ) {
    }



    public static function fromRequest(RegistrationRequest $request) {
        return new self(
            $request->username,
            $request->email,
            $request->password,
        );
    }
}
