<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Models\User;
use Domain\User\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends ParentController
{
    public function __invoke(LoginRequest $request)
    {
        try {
            $validated = $request->validated();

            if (!Auth::attempt($validated)) {
                return $this->error($validated, 'Invalid credentials');
            }

            $user = Auth::user();
            $token = $user->createToken(env('APP_NAME'))->plainTextToken;

            return $this->success($token);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
