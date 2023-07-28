<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'user_id',
        'alert_text',
        'seen',
        'send_on_email',
    ];
}
