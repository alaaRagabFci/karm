<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'price', 'calories', 'contents', 'category_id', 'is_active'];
    public $timestamps  = false;

    public function getCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function getImages()
    {
        return $this->hasMany('App\Models\MealImage');
    }

    public function getSizes()
    {
        return $this->hasMany('App\Models\MealSize');
    }

    public function getPromos()
    {
        return $this->hasMany('App\Models\Promocode');
    }

}
