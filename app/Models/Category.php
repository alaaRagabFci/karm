<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ['name', 'image', 'sort', 'is_active'];
    public $timestamps  = false;

    public function getMeals()
    {
        return $this->hasMany('App\Models\Meal');
    }

    public function getPromos()
    {
        return $this->hasMany('App\Models\Promocode');
    }
}
