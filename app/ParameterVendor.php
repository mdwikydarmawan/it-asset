<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterVendor extends Model
{

    protected $table = 'param_vendor'; 

    protected $fillable = [

        'id',
        'vendor_name',
        'vendor_address',
        'vendor_telephone'
    ];

}