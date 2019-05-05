<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = ['the_user_id', 'status', 'casher_id', 'driver_id', 'amount', 'receving_type_id'];
    public $timestamps  = false;

    public function getDriver()
    {
        return $this->belongsTo('App\Models\Worker','driver_id','id');
    }

    public function getCashair()
    {
        return $this->belongsTo('App\Models\Worker','casher_id','id');
    }

    public function getUser()
    {
        return $this->belongsTo('App\Models\TheUser','the_user_id','id');
    }

    public function getReceivingType()
    {
        return $this->belongsTo('App\Models\ReceivingType','receving_type_id','id');
    }

    public function getPromos()
    {
        return $this->hasMany('App\Models\Promocode');
    }

    public function getDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
