<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BAPKS extends Model
{

    protected $table = 'ba_pks'; 

    protected $fillable = [
        'id',
        'vendor_id',
        'pks_type_id',
        'pks_name',
        'pks_number',
        'pks_date',
        'pks_date_start',
        'pks_date_end',
        'fee',
        'status',
        'isHardCopy'
    ];

}