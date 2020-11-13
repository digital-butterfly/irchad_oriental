<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncorporationProgress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_incorporation',
        'id_step',
        'sort',
        'observation'
    ];
    protected $casts = [
        'date_creation' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',

    ];






    //
}
