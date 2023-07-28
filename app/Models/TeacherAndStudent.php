<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TeacherAndStudent extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'student_id',
        'teacher_id',
    ];
}
