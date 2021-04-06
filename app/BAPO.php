<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BAPO extends Model
{

    protected $table = 'ba_po'; 

    protected $fillable = [
        'id',
        'po_title',
        'po_no',
        'po_date',
        'vendor_id',
        'pic_id',
        'nominal',
        'isPKS',
        'pks_id',
        'quotation_no',
        'isPayment',
        'payment_date',
        'requirement',
        'isFile',
        'filename'
    ];

}