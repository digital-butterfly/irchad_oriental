<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Township;
use App\User;

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
        'state_help',
        'otherquestions',
        'informal_activity_desc',
        'informal_activity',
        'entre_activity',
        'project_idea',
        'formation_needs',
        'project_idea_desc',
        'chomage_desc',
        'informal_activity_nat',
        'entre_activity_nat',
        'cree_par'
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
        //$users_options = [];

    //     $users = User::all();

    //     foreach($users as $township) {
    //      array_push($townships_options, (object)[
    //     'id' => $township->id,
    //     'title' => $township->title
    //       ]);
    //   }

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
                'config' => ['tripleRepeater' => true,'attributes' => [['Type de diplôme',3], ['Année d\'obtention',2], ['Établissement',3]],'Select'=>false]
            ],
            [
                'name' => 'professional_experience',
                'type' => 'repeater',
                'label' => 'Experience professionnelle',
                'config' => ['quintupleRepeater' => true, 'attributes' => [['Poste',2], ['Du',1], ['Au',1],['Organisme',2], ['Mission',2]],'Select'=>false]
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
                'options' => ['Handicap auditif', 'Handicap vocal', 'Handicap moteur', 'Handicap visuel','Handicap mental']
            ], [
                'name' => 'chomage',
                'type' => 'select',
                'label' => 'Actuellement, êtes-vous au chômage ',
                'options' => ['Oui', 'Non',]
            ],[
                'name' => 'chomage_desc',
                'type' => 'textarea',
                'label' => 'Depuis combien de temps',
            ],
            [
                'name' => 'informal_activity',
                'type' => 'select',
                'label' => 'Exercez-vous une activité informelle',
                'options' => ['Oui','Non']
            ],
            [
                'name' => 'informal_activity_nat',
                'type' => 'textarea',
                'label' => ' De quelle nature ? ',
            ],
            [
                'name' => 'informal_activity_desc',
                'type' => 'textarea',
                'label' => ' Depuis combien de temps ?',
            ],
            [
                'name' => 'entre_activity',
                'type' => 'select',
                'label' => 'Exercez-vous une activité entreprenariale ?',
                'options' => ['Oui', 'Non']
            ],
            [
                'name' => 'entre_activity_desc',
                'type' => 'textarea',
                'label' => 'Depuis combien de mois?',
            ],
            [
                'name' => 'entre_activity_nat',
                'type' => 'textarea',
                'label' => 'De quel secteur ?',
            ],
            [
                'name' => 'project_idea',
                'type' => 'select',
                'label' => 'Avez-vous une idée de projet ?',
                'options' => ['Oui', 'Non',]
            ],
            [
                'name' => 'project_idea_desc',
                'type' => 'textarea',
                'label' => 'laquelle?',
            ],
            [
                'name' => 'formation_needs',
                'type' => 'select',
                'label' => 'Auriez-vous besoin d\'une formation',
                'options' => ['Oui', 'Non']
            ],
            [
                'name' => 'formation_needs_desc',
                'type' => 'textarea',
                'label' => 'laquelle',
            ],
            [
                'name' => 'cree_par',
                'type' => 'text',
                'label' => 'Créé par ',
            ],
        ];
    }
    public function getFullNameAttribute($value)
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
}
