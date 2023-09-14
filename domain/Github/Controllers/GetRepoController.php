<?php

declare(strict_types=1);

namespace Domain\Github\Controllers;

use App\Support\Parents\ParentController;
use Domain\Github\Actions\GetRepoAction;
use Domain\Github\Resources\GithubRepoResource;
use Illuminate\Http\Request;

class GetRepoController extends ParentController
{
    public function __construct(
        private readonly GetRepoAction $getRepoAction
    ) {
    }
    public function __invoke(Request $request, int $repo_id)
    {
        try {
            $repo = ($this->getRepoAction)($repo_id);

            return $this->success(
                new GithubRepoResource($repo)
            );
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
