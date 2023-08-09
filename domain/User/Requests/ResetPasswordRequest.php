<?php

declare(strict_types=1);

namespace Domain\User\Requests;

use App\Support\Parents\ParentRequest;
use Illuminate\Validation\Rule;

class ResetPasswordRequest extends ParentRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::exists('users', 'email'),
            ],
        ];
    }
}
