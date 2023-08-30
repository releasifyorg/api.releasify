<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Actions\DeleteTeamAction;
use Domain\Team\Models\Team;
use Illuminate\Http\Request;

class  DeleteTeamController extends ParentController
{
    public function __construct(
        private readonly DeleteTeamAction $deleteTeamAction,
    ) {
    }

    public function __invoke(Request $request, Team $team)
    {
        try {
            ($this->deleteTeamAction)($team);

            return $this->noContent();
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
