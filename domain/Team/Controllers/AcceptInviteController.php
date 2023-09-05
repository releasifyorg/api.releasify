<?php

declare(strict_types=1);

namespace Domain\Team\Controllers;

use App\Support\Parents\ParentController;
use Domain\Team\Actions\AcceptInviteAction;
use Domain\Team\Actions\SendInviteAction;
use Domain\Team\DTO\SendInviteData;
use Domain\Team\Models\Invite;
use Domain\Team\Models\Team;
use Domain\Team\Resources\InviteResource;
use Domain\User\Models\User;
use Illuminate\Http\Request;

class AcceptInviteController extends ParentController
{
    public function __construct(
        private readonly AcceptInviteAction $acceptInviteAction
    ) {
    }
    public function __invoke(Request $request, Invite $invite)
    {
        try {
            ($this->acceptInviteAction)($invite, $request->user());

            return $this->noContent();
        } catch (\Exception $e) {
            return $this->error(
                [],
                $e->getMessage()
            );
        }
    }
}
