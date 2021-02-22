<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class groups extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',

    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',

    ];


    public static function formFields($value) {
//        dd($value);
        if ($value!=null){
            $sessionMembers = groupSessionMembers::where('group_id','=', $value)->get()->map(function($member){
                $user=$member->getAdhname->only(['id','first_name','last_name']);
                $proj=$member->getParentProject->only(['id','title']);

                return [
                    'member_id'=>$user['id'],
                    'value'=>$user['first_name'].' '. $user['last_name'],
                    "project_id"=>$proj['id'],
                    "project_title"=>$proj['title']

                ];
            });
            $sessionProjects= groupSessionMembers::select('group_id','id_projet')->where('group_id','=', $value)->groupBy('group_id','id_projet')->get()->map(function($project){
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

//dd($sessionMembers);


//        dump($data->toArray());
//        dd($projectApplicationMembers);

        return [
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Nom du group',
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
                'name' => 'candidatures',
                'type' => 'taggify',
                'id'=>'tagifycandidatures',
                'label' => 'Candidatures',
                'value'=>$sessionProjects
            ],





        ];
}}
