<?php

namespace Domain\Team\Resources;

use Domain\User\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'name' => $this['name'],
            'user_id' => $this['user_id'],
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
