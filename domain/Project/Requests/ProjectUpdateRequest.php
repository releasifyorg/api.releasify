<?php

declare(strict_types=1);

namespace Domain\Project\Requests;

use App\Support\Parents\ParentRequest;
use Illuminate\Validation\Rule;

class ProjectUpdateRequest extends ParentRequest
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
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'is_private' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}
