<?php

declare(strict_types=1);

namespace Domain\User\Requests;

use App\Support\Parents\ParentRequest;

class LoginRequest extends ParentRequest
{
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'min:4',
                'max:32',
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
