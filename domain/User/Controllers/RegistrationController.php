<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Actions\CreateUserAction;
use Domain\User\DTO\CreateUserData;
use Domain\User\Models\User;
use Domain\User\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends ParentController
{
    public function __construct(
        private readonly CreateUserAction $createUserAction
    ) {
    }

    public function __invoke(RegistrationRequest $request)
    {
        try {

            $userData = CreateUserData::fromRequest($request);

            $user = ($this->createUserAction)($userData);

            return $this->success(
                $user->createToken(env('APP_NAME'))->plainTextToken
            );

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
