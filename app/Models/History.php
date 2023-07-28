<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'lesson_id',
        'student_name',
        'question',
        'number_class',
        'subject',
        'start_time',
        'duration',
        'pause',
        'cost',
    ];
}
