<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TheUser extends Model
{
    protected $table = "the_users";
    protected $fillable = ['username', 'email', 'phone', 'is_active', 'is_blocked', 'token'];
    public $timestamps  = false;

    public function getAddresses()
    {
        return $this->hasMany('App\Models\UserAddress');
    }

    public function getDevicesTokens()
    {
        return $this->hasMany('App\Models\UserDevice');
    }

    public function getOrders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
