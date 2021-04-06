<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevelopmentApplication extends Model
{

    protected $table = 'dev_applications'; 

    protected $fillable = [

        'id',
        'application_name',
        'application_function',
        'label_producition',
        'label_drc',
        'label_development',
        'dev_by',
        'pic',        
        'application_database',
        'implementation_year',
        'source_code',
        'isMaintenance'

    ];

}