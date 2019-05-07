<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['username', 'display_name', 'email', 'phone','image', 'type', 'password', 'is_blocked', 'token'];
    public $timestamps  = false;

    public function getOrders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
