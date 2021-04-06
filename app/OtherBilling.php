<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherBilling extends Model
{

    protected $table = 'other_billing_payment'; 

    protected $fillable = [
        'id',
        'bill_title',
        'bill_no',
        'bill_date',
        'vendor_id',
        'nominal',
        'information',
        'created_by',
        'isFile',
        'filename',
        'isGA'
    ];

}