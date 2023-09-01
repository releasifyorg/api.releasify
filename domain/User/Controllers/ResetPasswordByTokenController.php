<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Actions\DeleteUserAction;
use Domain\User\Actions\ResetPasswordAction;
use Domain\User\Actions\ResetPasswordByTokenAction;
use Domain\User\Actions\SendMailResetPasswordAction;
use Domain\User\Models\User;
use Domain\User\Requests\ResetPasswordByTokenRequest;
use Domain\User\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordByTokenController extends ParentController
{
    public function __construct(
        private readonly ResetPasswordByTokenAction $resetPasswordByTokenAction,
    ) {
    }

    public function __invoke(ResetPasswordByTokenRequest $request)
    {
        try {
            $reset = DB::table('password_reset_tokens')->where('token', $request->token);

            $isUpdated = ($this->resetPasswordByTokenAction)($reset, $request);

            if (!$isUpdated) {
                return $this->error([], 'Failed to update password.');
            }

            $returnData = [
                'new_password' => $request->new_password,
            ];

            return $this->success($returnData);
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
