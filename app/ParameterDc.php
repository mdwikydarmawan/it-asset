<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterDc extends Model
{

    protected $table = 'param_dc'; 

    protected $fillable = [
        'id',
        'dc_name',
        'dc_telephone',
        'dc_address'
    ];

}