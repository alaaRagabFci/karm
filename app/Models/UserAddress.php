<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = "user_addresses";
    protected $fillable = ['user_id', 'region_id', 'latitude', 'longitude','description', 'street'];
    public $timestamps  = false;

    public function getUser()
    {
        return $this->belongsTo('App\Models\TheUser','user_id','id');
    }

    public function getRegion()
    {
        return $this->belongsTo('App\Models\Region','region_id','id');
    }
}
