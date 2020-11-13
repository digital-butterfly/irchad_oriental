<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fundingcpdh extends Model
{
    /**
     * Custom function.
     *
     */
    public static function formFields() {
        return [
            [
                'name' => 'status_cpdh',
                'type' => 'select',
                'label' => 'Statut',
                'options' => ['En cours', 'Accepté', 'Refusé']
            ],
            [
                'name' => 'observation_cpdh',
                'type' => 'textarea',
                'label' => 'Observation'
            ], [
                'name' => 'montant',
                'type' => 'number',
                'label' => 'Montant'
            ],
        ];
    }
}
