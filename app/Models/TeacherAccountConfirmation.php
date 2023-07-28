<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TeacherAccountConfirmation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'account_confirmation',
    ];
}
