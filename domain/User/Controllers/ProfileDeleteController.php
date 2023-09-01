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
                throw new \Exception('Database deleting error', 500);
            }

            return $this->noContent();
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
