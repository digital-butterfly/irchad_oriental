<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class groupSessionMembers extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'group_id',
        'id_projet',
        'id_member'


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
    public function getAdhname()
    {
        return $this->belongsTo('App\Member','id_member');
    }
    public function getParentProject(){
        return $this->belongsTo('App\ProjectApplication', 'id_projet');
    }
}
