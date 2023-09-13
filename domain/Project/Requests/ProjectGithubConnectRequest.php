<?php

declare(strict_types=1);

namespace Domain\Project\Requests;

use App\Support\Parents\ParentRequest;
use Illuminate\Validation\Rule;

class ProjectGithubConnectRequest extends ParentRequest
{
    public function rules(): array
    {
        return [
            'github_repo_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    ray($this->user()->projects);
                    if ($this->user()->projects->where('github_repo_id', $value)->isNotEmpty()) {
                        $fail('You already have a project with this github repo id.');
                    }
                },
            ],
        ];
    }
}
