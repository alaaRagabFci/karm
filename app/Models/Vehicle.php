<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'image', 'imei', 'serial_number', 'registeration_type', 'plate_number', 'driver_id',
                           'company_id', 'left_letter', 'middle_letter', 'right_letter', 'owner_name', 'owner_id', 'username',
                           'brand', 'model', 'model_year', 'initial_weight', 'color', 'license_expiry_date', 'is_sent'];
    public function getDriver()
    {
        return $this->belongsTo('App\Models\Driver','driver_id','id');
    }

    public function getCompany()
    {
        return $this->belongsTo('App\Models\Company','company_id','id');
    }

    public function geofenses()
    {
        return $this->belongsToMany('App\Models\Geofence','vehicle_geofence','vehicle_id','geofense_id');
    }
    public $timestamps  = false;
}
