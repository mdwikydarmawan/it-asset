<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevelopmentApplicationEnhancement extends Model
{

    protected $table = 'dev_applications_enhancement'; 

    protected $fillable = [

        'id',
        'application_id',
        'title',
        'cr_number',
        'request_date',
        'submit_date',
        'live_date',
        'user_owner',
        'application_information',
        'pic'
    ];

}