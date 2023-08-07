<?php

namespace Domain\Github\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GithubRepoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this['name'],
            'full_name' => $this['full_name'],
            'private' => $this['private'],
            'html_url' => $this['html_url'],
            'description' => $this['description'],
            'disabled' => $this['disabled'],
        ];
    }
}
