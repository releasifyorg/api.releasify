<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\DTO\CreateUserData;
use Domain\User\DTO\UpdateUserData;
use Domain\User\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{
    public function __invoke(User $user, UpdateUserData $data): User
    {
        $updateData = [
            'name' => $data->name ?? $user->name,
            'username' => $data->username ?? $user->username,
            'avatar_url' => $data->avatar_url ?? $user->avatar_url,
            'email' => $data->email ?? $user->email,
            'password' => $data->password ?? $user->password,
        ];

        $user->update($updateData);

        return $user->fresh();
    }
}
