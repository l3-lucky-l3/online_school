<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TeacherBalance extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'balance',
    ];
}
