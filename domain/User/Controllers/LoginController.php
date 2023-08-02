<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Models\User;
use Domain\User\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends ParentController
{
    public function __invoke(LoginRequest $request)
    {
        try {

            if (!Auth::attempt($request->toArray())) {
                return $this->validation('Invalid credentials');
            }

            $user = Auth::user();

            return $this->success(
                $user->createToken(env('APP_NAME'))->plainTextToken
            );

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
