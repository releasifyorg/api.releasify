<?php

declare(strict_types=1);

namespace Domain\Project\Requests;

use App\Support\Parents\ParentRequest;

class CreateCommitRequest extends ParentRequest
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
            'body' => [
                'nullable',
                'string',
                'max:1024',
            ],
            'prerelease' => [
                'required',
                'boolean',
            ],
            'make_latest' => [
                'required',
                'boolean',
            ],
            'tag_name' => [
                'required',
                'string',
                'min:2',
                'max:8',
            ],
        ];
    }
}
