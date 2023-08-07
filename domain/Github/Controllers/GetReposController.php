<?php

declare(strict_types=1);

namespace Domain\Github\Controllers;

use App\Support\Parents\ParentController;
use Domain\Github\Resources\GithubRepoResource;
use Illuminate\Http\Request;

class GetReposController extends ParentController
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        $repos = $user->github()->currentUser()->repositories();

        return GithubRepoResource::collection($repos);
    }
}
