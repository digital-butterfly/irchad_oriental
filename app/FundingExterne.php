<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundingExterne extends Model
{

    protected $casts =[
        'date_prise_charge' => 'datetime:d-m-Y',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'funding_organism',
        'date_prise_charge_ext',
        'observation_ext',
        'status_ext',
        'id_projet',
        'montant'

    ];
}
