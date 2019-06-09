<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $fillable = ['promo_type', 'value', 'code', 'type', 'expiration_date', 'trips_limit', 'description', 'category_id', 'is_active'];
    public $timestamps  = false;

    public function getCateories()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function getOrders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function getMeals()
    {
        return $this->hasMany('App\Models\Meal');
    }

    public function getCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
}
