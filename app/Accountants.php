<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountants extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'tel',
        'e-mail',
        'address'
    ];

    /**
     * Custom function.
     *
     */
    public static function formFields() {
        return [

            [
                'name' => 'gender',
                'type' => 'select',
                'label' => 'Sexe',
                'options' => ['Homme', 'Femme']
            ],[
                'name' => 'first_name',
                'type' => 'text',
                'label' => 'Nom'
            ],[
                'name' => 'last_name',
                'type' => 'text',
                'label' => 'Prénom'
            ],[
                'name' => 'tel',
                'type' => 'text',
                'label' => 'Numero de téléphone'
            ],[
                'name' => 'e-mail',
                'type' => 'text',
                'label' => 'Email'
            ],[
                'name' => 'address',
                'type' => 'textarea',
                'label' => 'Address'
            ],
        ];
    }
}
