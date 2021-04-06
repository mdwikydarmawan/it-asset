<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpdeskRecap extends Model
{

    protected $table = 'helpdesk_recap'; 

    protected $fillable = [
        'id',
        'file_name',
        'periode_start',
        'periode_end',
        'recap_information'
    ];

}