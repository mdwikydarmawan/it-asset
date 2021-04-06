<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpdeskServer extends Model
{

    protected $table = 'helpdesk_server'; 

    protected $fillable = [
        'id',
        'dc_id',
        'server_name',
        'device_name',
        'label_name',
        'label_information',
        'serial_number',
        'server_specification',
        'server_ip_address',
        'server_username',
        'server_password'

    ];

}