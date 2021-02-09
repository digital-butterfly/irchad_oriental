<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectApplicationMember extends Model
{
    //
    protected $fillable=[
        'project_application_id',
        'member_id'
    ];
    public function getUser(){

        return $this->belongsTo('App\Member', 'member_id');
    }
    public function getProject(){

        return $this->belongsTo('App\ProjectApplication', 'project_application_id');
    }

//    public function getProjectIns(){
////        return $this->hasMany('App\ProjectApplicationMember', 'project_application_id');
////        dump(AdherentSession::where('id_member',$this->member_id)->firstOrFail());
//     return $this->hasMany('App\ProjectApplication');
//    }
}
