<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'role',
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
    /* protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */

    /**
     * Custom function.
     *
     */
    public static function formFields() {
        return [
            [
                'name' => 'first_name',
                'type' => 'text',
                'label' => 'Prénom',
                'value' => 'Some Value'
            ],
            [
                'name' => 'last_name',
                'type' => 'text',
                'label' => 'Nom de famille',
                'value' => 'Some Value'
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'value' => 'Some Value'
            ],
            [
                'name' => 'password',
                'type' => 'password',
                'label' => 'Mot de passe',
                'value' => 'Some Value'
            ],
            [
                'name' => 'role',
                'type' => 'select',
                'label' => 'Role',
                'options' => ['Super Administrateur', 'Administrateur'],
                'value' => 'Some Value'
            ],
        ];
    }
}
