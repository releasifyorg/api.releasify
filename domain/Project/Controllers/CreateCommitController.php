<?php

declare(strict_types=1);

namespace Domain\Project\Controllers;

use App\Support\Parents\ParentController;
use Domain\Project\Action\CreateCommitAction;
use Domain\Project\DTO\CreateCommitData;
use Domain\Project\Models\Project;
use Domain\Project\Requests\CreateCommitRequest;
use Domain\Project\Resources\CommitResource;

class CreateCommitController extends ParentController
{
    public function __construct(
        private readonly CreateCommitAction $createCommitAction
    ) {
    }

    public function __invoke(CreateCommitRequest $request, Project $project)
    {
        try {
            $commitData = CreateCommitData::fromObjects($request, $project);

            $commit = ($this->createCommitAction)($commitData);

            return $this->success(new CommitResource($commit));
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
