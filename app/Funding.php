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
