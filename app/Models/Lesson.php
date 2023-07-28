<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'question',
        'name',
        'user_id',
        'number_class',
        'subject',
        'start_time',
        'duration',
        'pause',
        'cost',
    ];
}
