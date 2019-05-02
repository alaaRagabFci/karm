<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromocodeOrder extends Model
{
    protected $table = "promocodes_orders";
    protected $fillable = ['promo_code_id', 'user_id', 'order_id'];
    public $timestamps  = false;
}
