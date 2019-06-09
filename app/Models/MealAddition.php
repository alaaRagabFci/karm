<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealAddition extends Model
{
    protected $table = "meal_additions";
    protected $fillable = ['addition_id', 'meal_id', 'price', 'sort'];
    public $timestamps  = false;

    public function getMeal()
    {
        return $this->belongsTo('App\Models\Meal','meal_id','id');
    }

    public function getAddition()
    {
        return $this->belongsTo('App\Models\Addition','addition_id','id');
    }
}
