<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Models\User;
use Domain\User\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends ParentController
{
    public function __invoke(RegistrationRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = $this->createUser($validated);

            //TODO: send email (confirmation, auth data or smthng like that)

            $token = $user->createToken(env('APP_NAME'))->plainTextToken;
            $responseData = ['token' => $token];

            return $this->success($responseData);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    private function createUser(array $userData) {
        return User::create([
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);
    }
}
