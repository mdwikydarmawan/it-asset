<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevelopmentVendorNonApp extends Model
{

    protected $table = 'dev_vendor_non_app'; 

    protected $fillable = [
        'id',
        'vendor_name',
        'vendor_address',
        'vendor_telephone',
        'vendor_information',
        'isMaintenance'
    ];

}