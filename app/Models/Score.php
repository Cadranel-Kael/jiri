<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'score',
        'comment',
    ];

    public function presentation(): HasOne
    {
        return $this->hasOne(Presentation::class, 'presentation_id');
    }

    public function evaluator(): HasOne
    {
        return $this->hasOne(Contact::class, 'contact_id');
    }

}
