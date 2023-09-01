<?php

namespace Domain\Team\Resources;

use Domain\User\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InviteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'team_id' => $this['team_id'],
            'sender_id' => $this['sender_id'],
            'email' => $this['email'],
            'accepted_at' => $this['accepted_at'],
        ];
    }
}
