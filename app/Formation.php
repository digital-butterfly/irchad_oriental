<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Formation extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'domaine',
    ];



    public static function formFields() {



        return [
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Intitulé'
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Description'
            ],
            [
                'name' => 'domaine',
                'type' => 'text',
                'label' => 'Domaine'
            ],


        ];
    }
}
