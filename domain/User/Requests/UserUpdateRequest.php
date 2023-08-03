<?php

declare(strict_types=1);

namespace Domain\User\Requests;

use App\Support\Parents\ParentRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends ParentRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
                'string',
                'min:4',
                'max:32',
            ],
            'username' => [
                'nullable',
                'string',
                'min:4',
                'max:32',
                Rule::unique('users', 'username'),
            ],
            'avatar_url' => [
                'nullable',
                'string',
                'url'
            ],
            'email' => [
                'email',
                'string',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'string',
                'min:6',
                'max:64',
            ],
        ];
    }
}
