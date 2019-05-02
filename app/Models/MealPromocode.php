<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPromocode extends Model
{
    protected $table = "meal_promocodes";
    protected $fillable = ['promo_code_id', 'meal_id'];
    public $timestamps  = false;
}
