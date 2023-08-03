<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Actions\DeleteUserAction;
use Domain\User\Models\User;
use Illuminate\Http\Request;

class ProfileDeleteController extends ParentController
{
    public function __construct(
        private readonly DeleteUserAction $deleteUserAction
    ) {
    }

    public function __invoke(Request $request)
    {
        try {
            $isDeleted = ($this->deleteUserAction)($request);

            if (!$isDeleted) {
                return $this->error([], 'Database deleting error');
            }

            return $this->noContent();
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
