<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpdeskHardware extends Model
{

    protected $table = 'helpdesk_hardware'; 

    protected $fillable = [
        'id',
        'hardware_id',
        'hardware_total',
        'created_at',
        'updated_at'
    ];

}