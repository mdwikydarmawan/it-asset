<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuidanceDoc extends Model
{

    protected $table = 'guidance_document'; 

    protected $fillable = [
        'id',
        'doc_name',
        'doc_function',
        'filename',
        'doc_date',
        'uploaded_by'
    ];

}