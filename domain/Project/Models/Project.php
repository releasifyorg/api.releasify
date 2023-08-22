<?php

namespace Domain\Project\Models;

use Domain\Team\Models\Team;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'is_private',
        'user_id',
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
        return $this->belongsTo(Team::class)->exists();
    }
}
