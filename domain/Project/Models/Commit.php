<?php

namespace Domain\Project\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Project;

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
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
