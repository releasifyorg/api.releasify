<?php

namespace Domain\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Domain\Project\Models\Project;
use Domain\Team\Models\Invite;
use Domain\Team\Models\Team;
use Github\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'github_id',
        'github_access_token',
        'avatar_url',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'github_id',
        'github_access_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function github(): Client
    {
        $client = new \Github\Client();
        $client->authenticate($this->github_access_token, null, \Github\AuthMethod::ACCESS_TOKEN);

        return $client;
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function invitesSent(): HasMany
    {
        return $this->hasMany(Invite::class, 'sender_id');
    }

    public function invitesReceived(): HasMany
    {
        return $this->hasMany(Invite::class, 'email', 'email');
    }
}
