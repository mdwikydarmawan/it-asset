<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterPKS extends Model
{

    protected $table = 'param_pks'; 

    protected $fillable = [
        'id',
        'pks_type',
        'pks_type_information'
    ];

}