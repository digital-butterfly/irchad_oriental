<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{


    /**
     * Custom function.
     *
     */
    public static function formFields() {
        return [

            [
                    'group'=>'indh',
                'name' => 'status_indh',
                'type' => 'select',
                'label' => 'Statut',
                'options' => ['En cours', 'Prêt pour envoi au CT']
            ],
            [
                'group'=>'indh',
                'name' => 'date_prise_charge',
                'type' => 'date',
                'label' => 'Date de prise en charge '
            ], [
                'group'=>'ext',
                'name' => 'status_ext',
                'type' => 'select',
                'label' => 'Statut',
                'options' => ['En cours', 'Accepté','Refusé']
            ],
            [
                'group'=>'ext',
                'name' => 'funding_organism',
                'type' => 'text',
                'label' => 'Organisme de financement',
            ],
            [
                'group'=>'ext',
                'name' => 'date_prise_charge_ext',
                'type' => 'date',
                'label' => 'Date de prise en charge'
            ],[
                'group'=>'ext',
                'name' => 'montant',
                'type' => 'number',
                'label' => 'Montant'
            ],[
                'group'=>'ext',
                'name' => 'observation_ext',
                'type' => 'textarea',
                'label' => 'Observation'
            ],
        ];
    }
}
