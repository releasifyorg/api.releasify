<?php

namespace Domain\Team\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $table = 'invites';

    protected $fillable = [
        'team_id',
        'sender_id',
        'email',
        'accepted_at',
    ];
}
