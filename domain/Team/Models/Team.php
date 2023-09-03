<?php

namespace Domain\Team\Models;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function hasUser(User $user): bool
    {
        return $this->users()->get()->contains($user);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function invites(): HasMany
    {
        return $this->hasMany(Invite::class);
    }
}
