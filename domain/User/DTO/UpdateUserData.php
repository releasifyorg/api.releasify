<?php

declare(strict_types=1);

namespace Domain\User\DTO;

use Domain\User\Requests\RegistrationRequest;
use Domain\User\Requests\UserUpdateRequest;
use Spatie\LaravelData\Data;

class UpdateUserData extends Data
{
    public function __construct(
        public ?string $name,
        public ?string $username,
        public ?string $avatar_url,
        public ?string $email,
        public ?string $password,
    ) {
    }



    public static function fromRequest(UserUpdateRequest $request) {
        return new self(
            $request->name,
            $request->username,
            $request->avatar_url,
            $request->email,
            $request->password,
        );
    }
}
