<?php

declare(strict_types=1);

namespace Domain\Team\Actions;

use Domain\Project\Models\Project;
use Domain\Team\Models\Team;
use Domain\User\DTO\CreateUserData;
use Domain\User\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeleteTeamAction
{
    public function __invoke(Team $team): bool
    {
        try {
            $team->delete();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
