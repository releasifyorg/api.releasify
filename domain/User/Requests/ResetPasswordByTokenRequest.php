<?php

declare(strict_types=1);

namespace Domain\User\Requests;

use App\Support\Parents\ParentRequest;
use Illuminate\Validation\Rule;

class ResetPasswordByTokenRequest extends ParentRequest
{
    public function rules(): array
    {
        return [
            'token' => [
                'required',
                Rule::exists('password_reset_tokens', 'token'),
            ],
            'new_password' => [
                'required',
                'confirmed',
                'min:6',
                'max:64',
            ],
        ];
    }
}
