<?php

declare(strict_types=1);

namespace Domain\Project\Requests;

use App\Support\Parents\ParentRequest;
use Illuminate\Validation\Rule;

class CreateProjectRequest extends ParentRequest
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
            'description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'is_private' => [
                'required',
                'boolean',
            ],
            'github_repo_id' => [
                'nullable',
                'integer',
            ],
            'user_id' => [
                'required_without:team_id',
                'prohibits:team_id',
                'integer',
                Rule::exists('users', 'id'),
                function($attribute, $value, $fail) {
                    if (auth()->id() != $value) {
                        $fail('The user_id must match the authenticated user.');
                    }
                },
            ],
            'team_id' => [
                'required_without:user_id',
                'prohibits:user_id',
                'integer',
                Rule::exists('teams', 'id'),
                function($attribute, $value, $fail) {
                    if (!auth()->user()->teams()->where('teams.id', $value)->exists()) {
                        $fail('The team_id must match one of the authenticated user\'s teams.');
                    }
                },
            ],
        ];
    }
}
