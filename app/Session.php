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
                $proj=$member->getParentProject->only(['id','title']);


                return [
                    'member_id'=>$user['id'],
                    'value'=>$user['first_name'].' '. $user['last_name'],
                    "project_id"=>$proj['id'],
                    "project_title"=>$proj['title'],
                    "id_session"=>$member->id
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
        $group = groups::all();



//        dump($data->toArray());
//        dd($projectApplicationMembers);

        return [
            [
                'name' => 'id_Group',
                'type' => 'select',
                'label' => 'Group',
                'options'=>$group,
                'group'=>'session'
            ],[
                'name' => 'members',
                'type' => 'taggify',
                'id'=>'kt_tagify_1',
                'class' => 'kt-callout--dark',
                'label' => 'Des Adhérent',
                'value'=> $sessionMembers,
                'group'=>'session'

//                'value'=> []
            ],
            [
                'name' => 'candidatures',
                'type' => 'taggify',
                'id'=>'tagifycandidatures',
                'label' => 'Candidatures',
                'value'=>$sessionProjects,
                'group'=>'session'
            ],

            [
                'name' => 'id_formation',
                'type' => 'select',
                'label' => 'Formation',
                'options'=>$formation,

                'group'=>'session'
            ],
            [
                'name' => 'max_inscrit',
                'type' => 'number',
                'label' => 'Nombre max d\'Inscrit',
                'group'=>'session'
            ],
            [
                'name' => 'start_date',
                'type' => 'date',
                'label' => 'Date début',
                'group'=>'session'
            ],  [
                'name' => 'end_date',
                'type' => 'date',
                'label' => 'Date fin',
                'group'=>'session'
            ],
            [
                'name' => 'sort',
                'type' => 'select',
                'label' => 'Sort',
                'options' => ['En file d\'attente', 'En cours', 'Terminée', 'Annulée'],
                'group'=>'session'
            ] ,[
                'name' => 'observation',
                'type' => 'textarea',
                'label' => 'Observation',
                 'group'=>'session'
            ],
            [
                'name' => 'sort',
                'type' => 'text',
                'label' => 'sort',
                'group'=>'notation'
            ],
            [
                'name' => 'observations',
                'type' => 'text',
                'label' => 'Observation',
                'group'=>'notation'
            ],





        ];
    }
    public function getFormation(){

        return $this->belongsTo('App\Formation', 'formation_id');
    }
}
