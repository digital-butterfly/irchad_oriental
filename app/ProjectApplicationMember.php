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
}
