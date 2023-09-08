<?php

namespace Domain\Project\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommitResource extends JsonResource
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
            'body' => $this['body'],
            'prerelease' => $this['prerelease'],
            'make_latest' => $this['make_latest'],
            'tag_name' => $this['tag_name'],
            'project_id' => $this['project_id'],
        ];
    }
}
