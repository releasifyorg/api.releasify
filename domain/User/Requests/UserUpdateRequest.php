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
                'required',
                'string',
                'min:4',
                'max:32',
            ],
            'username' => [
                'required',
                'min:4',
                'max:32',
                Rule::unique('users', 'username')->ignore($this->user()->id),
            ],
            'avatar_url' => [
                'required',
                'string',
                'url'
            ],
            'email' => [
                'required',
                'email',
                'string',
                Rule::unique('users', 'email')->ignore($this->user()->id),
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
