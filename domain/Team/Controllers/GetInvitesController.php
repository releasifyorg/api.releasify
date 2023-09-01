<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Resources\InviteResource;
use Illuminate\Http\Request;

class GetInvitesController extends ParentController
{
    public function __invoke(Request $request)
    {
        try {
            $invites = $request->user()->invitesReceived()
                ->whereNull('accepted_at')->get();

            return $this->success(InviteResource::collection($invites));
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
