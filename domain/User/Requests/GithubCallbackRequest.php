<?php

declare(strict_types=1);

namespace Domain\User\Requests;

use App\Support\Parents\ParentRequest;

class GithubCallbackRequest extends ParentRequest
{
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'min:20',
                'max:20',
            ],
        ];
    }
}
