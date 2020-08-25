<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $table = 'projects_categories';

    public $timestamps = false;

    protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'parent_id',
    ];

    /**
     * Custom function.
     *
     */
    public static function formFields() {

        $categories = ProjectCategory::where('parent_id', NULL)->get();

        $options = [];

        foreach($categories as $category) {
            array_push($options, (object)[
                'id' => $category->id,
                'title' => $category->title
            ]);
        }

        return [
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Titre'
            ],
            [
                'name' => 'parent_category',
                'type' => 'select',
                'label' => 'Parent',
                'options' => $options,
            ],
        ];
    }
    public function getParent(){
        return $this->belongsTo('App\ProjectCategory', 'parent_id');
    }
}

