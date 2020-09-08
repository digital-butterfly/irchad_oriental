<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'id_formation',
        'max_inscrit',
        'start_date',
        'end_date',
        'sort',
        'observation',
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


    public static function formFields($value) {
//        dd($value);
        if ($value!=null){
            $sessionMembers = AdherentSession::where('id_session','=', $value)->get()->map(function($member){
                $user=$member->getAdhname->only(['id','first_name','last_name']);

                return [
                    'member_id'=>$user['id'],
                    'value'=>$user['first_name'].' '. $user['last_name']
                ];
            });
            $sessionProjects= AdherentSession::select('id_session','id_projet')->where('id_session','=', $value)->groupBy('id_session','id_projet')->get()->map(function($project){
                $user=$project->getParentProject->only(['id','title']);

                return [
                    'id'=>$user['id'],
                    'value'=>$user['title']
                ];
            });
//        dd($sessionProjects->toArray());
        }
        else{
            $sessionMembers =null;
            $sessionProjects=null;
        }
        $formation = Formation::all();



//        dump($data->toArray());
//        dd($projectApplicationMembers);

        return [
            [
                'name' => 'candidatures',
                'type' => 'taggify',
                'id'=>'tagifycandidatures',
                'label' => 'Candidatures',
                'value'=>$sessionProjects
            ],
            [
                'name' => 'members',
                'type' => 'taggify',
                'id'=>'kt_tagify_1',
                'class' => 'kt-callout--dark',
                'label' => 'Des Adhérent',
                'value'=> $sessionMembers

//                'value'=> []
            ],
            [
                'name' => 'id_formation',
                'type' => 'select',
                'label' => 'Formation',
                'options'=>$formation,
            ],
            [
                'name' => 'max_inscrit',
                'type' => 'number',
                'label' => 'Nombre max d\'Inscrit'
            ],
            [
                'name' => 'start_date',
                'type' => 'date',
                'label' => 'Date début'
            ],  [
                'name' => 'end_date',
                'type' => 'date',
                'label' => 'Date fin'
            ],
            [
                'name' => 'sort',
                'type' => 'select',
                'label' => 'Sort',
                'options' => ['En file d\'attente', 'En cours', 'Terminée', 'Annulée']
            ] ,[
                'name' => 'observation',
                'type' => 'textarea',
                'label' => 'Observation'
            ],



        ];
    }
    public function getFormation(){

        return $this->belongsTo('App\Formation', 'formation_id');
    }
}
