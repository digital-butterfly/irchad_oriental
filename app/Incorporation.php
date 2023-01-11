<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incorporation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_projet',
        'form_juridique',
        'title',
        'ICE',
        'date_creation'

    ];
    protected $casts = [
        'date_creation' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',


    ];

    const LEGALFORM=['S.A.R.L','S.A.R.L A.U','S.N.C','Coopérative','A.E','Personne Physique','Société en cours de formation'];


    public static function formFields() {



        return [
            [
                'name' => 'candidatures',
                'type' => 'taggify',
                'id'=>'tagifycandidatures',
                'label' => 'Candidatures',

            ],
            [
                'name' => 'form_juridique',
                'type' => 'select',
                'label' => 'Forme juridique',
                'options' =>self::LEGALFORM

            ],

            [
                'name' => 'sort',
                'type' => 'select',
                'label' => 'Sort',
                'options' => ['achevé','non-achevé']

            ],
            [
                'name' => 'observation',
                'type' => 'textarea',
                'label' => 'Observation',
                'value'=>''
            ],[
                'name' => 'title',
                'type' => 'text',
                'label' => 'Nom',
            ],[
                'name' => 'ICE',
                'type' => 'text',
                'label' => 'ICE',

            ],[
                'name' => 'date_creation',
                'type' => 'date',
                'label' => 'Date creation',

            ],




        ];
    }
}
