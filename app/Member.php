<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Township;

class Member extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $guard = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identity_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
        'gender',
        'birth_date',
        'address',
        'password',
        'township_id',
        'degrees',
        'professional_experience',
        'reduced_mobility',
        'state_help'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'date:d-m-Y',
        'degrees' => 'object',
        'professional_experience' => 'object',
        'state_help' => 'object',
    ];



    /**
     * Custom function.
     *
     */
    public static function formFields() {

        $townships_options = [];

        $townships = Township::all();

        foreach($townships as $township) {
            array_push($townships_options, (object)[
                'id' => $township->id,
                'title' => $township->title
            ]);
        }

        return [
            [
                'name' => 'first_name',
                'type' => 'text',
                'label' => 'Prénom'
            ],
            [
                'name' => 'last_name',
                'type' => 'text',
                'label' => 'Nom de famille'
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email'
            ],
            [
                'name' => 'phone',
                'type' => 'text',
                'label' => 'Téléphone'
            ],
            [
                'name' => 'password',
                'type' => 'password',
                'label' => 'Mot de passe'
            ],
            [
                'name' => 'status',
                'type' => 'select',
                'label' => 'Statut du compte',
                'options' => ['En cours d\'examen', 'Validé', 'Rejeté']
            ],
            [
                'name' => 'gender',
                'type' => 'select',
                'label' => 'Sexe',
                'options' => ['Homme', 'Femme']
            ],
            [
                'name' => 'identity_number',
                'type' => 'text',
                'label' => 'N° CIN'
            ],
            [
                'name' => 'birth_date',
                'type' => 'date',
                'label' => 'Date de naissance'
            ],
            [
                'name' => 'address',
                'type' => 'textarea',
                'label' => 'Addresse'
            ],
            [
                'name' => 'township_id',
                'type' => 'select',
                'label' => 'Commune',
                'options' => $townships_options
            ],
            [
                'name' => 'degrees',
                'type' => 'repeater',
                'label' => 'Diplômes',
                'config' => ['doubleRepeater' => true]
            ],
            [
                'name' => 'professional_experience',
                'type' => 'repeater',
                'label' => 'Experience professionnelle',
                'config' => ['doubleRepeater' => true]
            ],
            [
                'name' => 'state_help',
                'type' => 'repeater',
                'label' => 'Aide Etatique ',
                'config' => ['tripleRepeater' => true]
            ],
            [
                'name' => 'reduced_mobility',
                'type' => 'select',
                'label' => 'Mobilité réduite',
                'options' => ['Malentendant', 'Malvoyant', 'Déficience Motrice', 'Déficience Mentale']
            ],
        ];
    }
    public function getFullNameAttribute($value)
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
}
