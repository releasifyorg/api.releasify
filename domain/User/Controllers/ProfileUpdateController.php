<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Actions\DeleteUserAction;
use Domain\User\Actions\UpdateUserAction;
use Domain\User\DTO\UpdateUserData;
use Domain\User\Models\User;
use Domain\User\Requests\UserUpdateRequest;
use Domain\User\Resources\UserResource;
use Illuminate\Http\Request;

class ProfileUpdateController extends ParentController
{
    public function __construct(
        private readonly UpdateUserAction $updateUserAction
    ) {
    }

    public function __invoke(UserUpdateRequest $request)
    {
        try {
            $user = $request->user();

            $userData = UpdateUserData::fromRequest($request);

            $updatedUser = ($this->updateUserAction)($user, $userData);

            return $this->success(new UserResource($updatedUser));
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
