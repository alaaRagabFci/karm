<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealImage extends Model
{
    protected $table = "meal_images";
    protected $fillable = ['image', 'meal_id'];
    public $timestamps  = false;

    public function getMeal()
    {
        return $this->belongsTo('App\Models\Meal','meal_id','id');
    }
}
