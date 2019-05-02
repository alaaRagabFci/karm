<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    protected $fillable = ['name', 'price', 'meal_id'];
    public $timestamps  = false;

    public function getMeal()
    {
        return $this->belongsTo('App\Models\Meal','meal_id','id');
    }
}
