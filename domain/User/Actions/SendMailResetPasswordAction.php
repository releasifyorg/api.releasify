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
use Illuminate\Support\Facades\Mail;

class SendMailResetPasswordAction
{
    public function __invoke(User $user, string $reset_token)
    {
        Mail::send('emails.reset-password', [
            'username' => $user->username,
            'token' => $reset_token,
        ], function ($message) use ($user) {
            $message->from(env('MAIL_FROM_ADDRESS'), 'Password reset | ' . env('APP_NAME'));

            $message->to($user->email);
        });
    }
}
