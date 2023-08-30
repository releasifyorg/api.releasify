<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Illuminate\Http\Request;

class GetInvitesController extends ParentController
{
    public function __invoke(Request $request)
    {
        try {
            return $request->user()->invitesReceived()->whereNull('accepted_at')->get();
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
