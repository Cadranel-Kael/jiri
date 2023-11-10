<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'score',
        'comment',
        'evaluator_id',
        'student_id',
        'project_id',
    ];
}
