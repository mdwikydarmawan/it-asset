<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterHardware extends Model
{

    protected $table = 'param_hardware'; 

    protected $fillable = [
        'id',
        'param_hardware_asset_code',
        'param_hardware_name',
        'param_hardware_information',
        'created_at',
        'updated_at'
    ];

}