<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $table = "companies";
    protected $fillable = ['reference_key', 'company_name', 'password', 'identityNumber',
                           'commercialRecordNumber', 'commercialRecordIssueDateHijri', 'phoneNumber',
                           'extensionNumber', 'emailAddress', 'managerName', 'managerPhoneNumber',
                           'managerMobileNumber', 'is_sent'];
    public $timestamps  = false;
}
