<?php

declare(strict_types=1);

namespace Domain\User\Requests;

use App\Support\Parents\ParentRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends ParentRequest
{
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'min:4',
                'max:32',
                Rule::unique('users', 'username'),
            ],
            'email' => [
                'required',
                'email',
                'string',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:64',
            ],
        ];
    }
}
