<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Resources\UserResource;
use Illuminate\Http\Request;

class ProfileController extends ParentController
{
    public function __invoke(Request $request)
    {
        return $this->success(new UserResource($request->user()));
    }
}
