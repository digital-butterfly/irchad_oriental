<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdherentSession extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_session',
        'id_projet',
        'id_member',
        'sort',
        'observation'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'start_date' => 'datetime:d-m-Y',
        'end_date' => 'datetime:d-m-Y',

    ];
    public static function formFields() {



        return [

            [
                'name' => 'sort',
                'type' => 'text',
                'label' => 'sort'
            ],
            [
                'name' => 'observation',
                'type' => 'text',
                'label' => 'Observation'
            ],


        ];
    }

    public function getAdhname()
    {
        return $this->belongsTo('App\Member','id_member');
    }


    public function getParentProject(){
        return $this->belongsTo('App\ProjectApplication', 'id_projet');
    }
    public function getParentSession(){
        return $this->belongsTo('App\Session', 'id_session');
    }

}
