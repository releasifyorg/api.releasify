<?php

declare(strict_types=1);

namespace Domain\Github\Actions;

use Domain\Project\Models\Project;
use Domain\User\DTO\CreateUserData;
use Domain\User\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GetRepoAction
{
    public function __invoke(int $repo_id): array
    {
        $user = auth()->user();

        $repos = $user->github()->currentUser()->repositories();
        $repo = array_filter($repos, fn ($repo) => $repo['id'] == $repo_id);

        if (empty($repo)) {
            throw new \Exception('Repo not found.');
        }

        return reset($repo);
    }
}
