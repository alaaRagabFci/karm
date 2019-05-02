<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['facebook', 'twitter', 'instgram', 'location','phone', 'emergency_call'];
    public $timestamps  = false;
}
