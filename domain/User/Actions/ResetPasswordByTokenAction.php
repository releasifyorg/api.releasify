<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Carbon\Carbon;
use Domain\User\DTO\CreateUserData;
use Domain\User\Models\User;
use Domain\User\Requests\ResetPasswordByTokenRequest;
use Domain\User\Requests\ResetPasswordRequest;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordByTokenAction
{
    public function __invoke($reset, ResetPasswordByTokenRequest $request): bool
    {
        try {
            $user = User::where('email', $reset->first()->email)->first();

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            $reset->delete();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
