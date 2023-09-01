<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Resources\TeamResource;
use Illuminate\Http\Request;

class GetTeamsController extends ParentController
{
    public function __invoke(Request $request)
    {
        try {
            return $this->success(TeamResource::collection(
                $request->user()->teams
            ));
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
