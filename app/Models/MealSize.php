<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealSize extends Model
{
    protected $table = "meal_sizes";
    protected $fillable = ['meal_id', 'size', 'price'];
    public $timestamps  = false;

    public function getMeal()
    {
        return $this->belongsTo('App\Models\Meal','meal_id','id');
    }
}
