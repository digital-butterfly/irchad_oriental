<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fundingcpde extends Model
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
        'id_projet',
        'ready_cpdh',
        'sent_cpde',
        'status_cpde',
        'observation_cpde'

    ];

    /**
     * Custom function.
     *
     */
    public static function formFields() {
        return [
            [
                'name' => 'status_cpde',
                'type' => 'select',
                'label' => 'Statut',
                'options' => ['En cours', 'Accepté', 'Refusé']
            ],
            [
                'name' => 'observation_cpde',
                'type' => 'textarea',
                'label' => 'Observation'
            ],
        ];
    }
}
