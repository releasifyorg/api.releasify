<?php

declare(strict_types=1);

namespace Domain\User\Actions;

use Domain\User\DTO\CreateUserData;
use Domain\User\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeleteUserAction
{
    public function __invoke(Request $request): bool
    {
        try {
            DB::beginTransaction();

            $user = $request->user();

            //TODO: delete user's future dependencies

            $user->delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
