<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Actions\DeleteUserAction;
use Domain\User\Actions\ResetPasswordAction;
use Domain\User\Actions\SendMailResetPasswordAction;
use Domain\User\Models\User;
use Domain\User\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;

class ResetPasswordController extends ParentController
{
    public function __construct(
        private readonly ResetPasswordAction $resetPasswordAction,
        private readonly SendMailResetPasswordAction $sendMailResetPasswordAction,
    ) {
    }

    public function __invoke(ResetPasswordRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            $reset_token = ($this->resetPasswordAction)($request);

            if (is_null($reset_token)) {
                throw new \Exception('Database changes error.');
            }

            ($this->sendMailResetPasswordAction)($user, $reset_token);

            return $this->success($reset_token);
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
