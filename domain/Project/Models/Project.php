<?php

namespace Domain\Project\Models;

use Domain\Team\Models\Team;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'is_private',
        'github_repo_id',
        'user_id',
        'team_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function is_team_project(): bool
    {
        return $this->belongsTo(Team::class, 'team_id', 'id')->exists();
    }

    public function commits(): HasMany
    {
        return $this->hasMany(Commit::class);
    }
}
