<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MinuteCost extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'minute_cost',
    ];
}
