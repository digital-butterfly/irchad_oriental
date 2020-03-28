<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    public $timestamps = false;

    protected $guard = 'user';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * Custom function.
     *
     */
    public static function formFields() {
        return [
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Nom de la commune'
            ],
        ];
    }

    /**
     * Get the projects sheets associated with the township.
     */
    /* public function projects_sheets()
    {
        return $this->hasMany('App\ProjectSheet');
    } */
}
