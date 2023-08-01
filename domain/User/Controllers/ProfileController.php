<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Illuminate\Http\Request;

class ProfileController extends ParentController
{
    public function __invoke(Request $request)
    {
        return $request->user();
    }
}
