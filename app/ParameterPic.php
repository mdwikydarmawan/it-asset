<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParameterPic extends Model
{

    protected $table = 'param_pic'; 

    protected $fillable = [
        'id',
        'vendor_id',
        'pic_name',
        'pic_telephone'
    ];

}