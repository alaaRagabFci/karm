<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsMessage extends Model
{
    protected $fillable = ['message', 'user_type', 'type'];
    public $timestamps  = false;
}
