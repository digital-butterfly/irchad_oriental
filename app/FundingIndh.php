<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundingIndh extends Model
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
        'status_indh',
        'date_prise_charge',
        'id_projet'

    ];

    /**
     * Custom function.
     *
     */
    public static function formFields() {
        return [
            [
                'name' => 'status_indh',
                'type' => 'select',
                'label' => 'Statut',
                'options' => ['En cours', 'Prêt pour envoi au CT']
            ],
            [
                'name' => 'date_prise_charge',
                'type' => 'date',
                'label' => 'Date de prise en charge '
            ],
        ];
    }
}
