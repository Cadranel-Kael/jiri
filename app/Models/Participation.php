<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participation extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'score',
        'comments',
        'urls',
    ];

    protected $casts = [
        'score' => 'array',
        'comments' => 'array',
        'urls' => 'array',
    ];

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'project_id');
    }

    public function student(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function getTasksAttribute()
    {
        return json_decode($this->attributes['tasks'], true);
    }
}
