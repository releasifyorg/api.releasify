<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\DTO\CreateUserData;
use Domain\User\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function __invoke(CreateUserData $data): User
    {
        return User::create([
            'username' => $data->username,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
    }
}
