<?php

namespace Domain\Project\Models;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commit extends Model
{
    use HasFactory;

    protected $table = 'commits';

    protected $fillable = [
        'name',
        'body',
        'prerelease',
        'make_latest',
        'tag_name',
        'user_id',
        'project_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
