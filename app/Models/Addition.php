<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    protected $fillable = ['name'];
    public $timestamps  = false;

    public function getMeal()
    {
        return $this->hasMany('App\Models\Meal');
    }

}
