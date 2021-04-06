<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecLicense extends Model
{

    protected $table = 'sec_license'; 

    protected $fillable = [

        'id',
        'license_name',
        'license_expired_date',
        'license_information',

    ];

}