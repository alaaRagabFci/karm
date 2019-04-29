<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Geofence extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'type', 'area', 'user_id'];
    public function getUser()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function vehicles()
    {
        return $this->belongsToMany('App\Models\Vehicle','vehicle_geofence','geofense_id','vehicle_id');
    }

    protected $hidden = array('pivot');
    public $timestamps  = false;
}
