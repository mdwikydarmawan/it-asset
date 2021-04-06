<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecBranch extends Model
{

    protected $table = 'sec_branch'; 

    protected $fillable = [

        'id',
        'branch_name',
        'branch_code',
        'branch_address',
        'branch_telephone',
        'branch_ip_telkom',
        'branch_ip_lintas',
        'branch_indihome_id',
        'link_main',
        'bw_main',
        'link_second',
        'bw_second',
        'link_inet',
        'bw_inet',
        'created_at',
        'updated_at',

    ];

}