<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Carbon\Carbon;
use Domain\User\DTO\CreateUserData;
use Domain\User\Models\User;
use Domain\User\Requests\ResetPasswordRequest;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordAction
{
    public function __invoke(ResetPasswordRequest $request): ?string
    {
        try {
            DB::beginTransaction();

            // Remove old token
            DB::table('password_reset_tokens')
                ->where('email', $request->email)->delete();

            // Make a new one
            $token = hash('sha256', Str::random(40));

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            DB::commit();
            return $token;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }
}
