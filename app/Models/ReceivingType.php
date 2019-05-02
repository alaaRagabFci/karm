<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceivingType extends Model
{
    protected $table = "receiving_types";
    protected $fillable = ['type', 'is_active'];
    public $timestamps  = false;
}
