<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['image', 'sort', 'meal_id', 'is_active'];
    public $timestamps  = false;

    public function getMeal()
    {
        return $this->belongsTo('App\Models\Meal','meal_id','id');
    }
}
