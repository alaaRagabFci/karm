<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;
    protected $table = "order_details";
    protected $fillable = ['order_id', 'meal_id', 'quantity'];
    public $timestamps  = false;

    public function getOrder()
    {
        return $this->belongsTo('App\Models\Order','order_id','id');
    }

    public function getMeal()
    {
        return $this->belongsTo('App\Models\Meal','meal_id','id');
    }
}
