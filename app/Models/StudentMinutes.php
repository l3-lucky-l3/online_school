<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StudentMinutes extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'minutes',
    ];
}
