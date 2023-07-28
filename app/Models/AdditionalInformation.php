<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AdditionalInformation extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'teacher_subject',
        'teacher_classes',
        'teacher_comment',
    ];
}
