<?php

declare(strict_types=1);

namespace Domain\Team\Actions;

use Domain\Team\DTO\CreateTeamData;
use Domain\Team\Models\Team;
use Illuminate\Support\Facades\DB;

class CreateTeamAction
{
    public function __invoke(CreateTeamData $data): ?Team
    {
        try {
            DB::beginTransaction();

            $team = Team::create([
                'name' => $data->name,
                'user_id' => $data->user_id,
            ]);

            $team->users()->attach($data->user_id);

            DB::commit();
            return $team;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
