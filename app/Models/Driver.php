<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'identity_number', 'mobile', 'birth_date', 'image', 'company_id', 'is_sent'];
    public $timestamps  = false;

    public function getCompany()
    {
        return $this->belongsTo('App\Models\Company','company_id','id');
    }
}
