<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adherent extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'date:d-m-Y',
        'degrees' => 'object',
        'professional_experience' => 'object',
        'state_help' => 'object',
    ];
}
