<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPromocode extends Model
{
    protected $table = "category_promocodes";
    protected $fillable = ['promo_code_id', 'category_id'];
    public $timestamps  = false;

}
