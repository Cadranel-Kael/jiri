<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentation extends Model
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

    public function event(): BelongsTo
    {
        return $this->BelongsTo(Event::class);
    }

    public function project(): BelongsTo
    {
        return $this->BelongsTo(Project::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function getTasksAttribute()
    {
        return json_decode($this->attributes['tasks'], true);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }
}
