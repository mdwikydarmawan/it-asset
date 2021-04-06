<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterStatus extends Model
{

    protected $table = 'param_status'; 

    protected $fillable = [
        'id',
        'status_name',
        'status_information'
    ];

}