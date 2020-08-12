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

    //
    public function getAdhname()
    {
        return $this->belongsTo('App\Member','id_member');
    }
}
