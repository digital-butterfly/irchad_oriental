<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncorporationSteps extends Model
{
    protected $casts = [
        'date_creation' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',


    ];
}
