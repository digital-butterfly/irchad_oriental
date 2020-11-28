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
    public static function formFields() {
        return [
            [

                'name' => 'status_ext',
                'type' => 'select',
                'label' => 'Statut',
                'options' => ['En cours', 'Accepté','Refusé']
            ],
            [

                'name' => 'funding_organism',
                'type' => 'text',
                'label' => 'Organisme de financement',
            ],
//            [
//
//                'name' => 'date_prise_charge_ext',
//                'type' => 'date',
//                'label' => 'Date de prise en charge'
//            ]

            [

                'name' => 'montant',
                'type' => 'number',
                'label' => 'Montant'
            ],[

                'name' => 'observation_ext',
                'type' => 'textarea',
                'label' => 'Observation'
            ],];

}
}
