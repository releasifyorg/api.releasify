<?php

declare(strict_types=1);

namespace Domain\Team\Requests;

use App\Support\Parents\ParentRequest;
use Illuminate\Validation\Rule;

class CreateTeamRequest extends ParentRequest
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
        ];
    }
}
