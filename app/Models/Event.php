<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes, HasFactory;

    protected $casts = [
        'date' => 'datetime',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function contacts(): BelongsToMany
    {
        return $this
            ->belongsToMany(Contact::class, 'participants', 'event_id', 'contact_id');
    }

    public function evaluators(): BelongsToMany
    {
        return $this
            ->belongsToMany(Contact::class, 'participants', 'event_id', 'contact_id')
            ->withPivot('role')
            ->wherePivot('role', 'evaluators');
    }

    public function students(): BelongsToMany
    {
        return $this
            ->belongsToMany(Contact::class, 'participants', 'event_id', 'contact_id')
            ->withPivot('role')
            ->wherePivot('role', 'students');
    }
}
