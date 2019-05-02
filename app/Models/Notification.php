<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['notification', 'user_type', 'type'];
    public $timestamps  = false;
}
