<?php

namespace App;
use App\ProjectCategory;
use App\Township;

use Illuminate\Database\Eloquent\Model;

class ProjectSheet extends Model
{
    protected $table = 'projects_sheets';

    public $timestamps = false;

    protected $guard = 'user';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 
        'township_id', 
        'title', 
        'description', 
        'market_type', 
        'holder_profile', 
        'surface', 
        'equipment', 
        'production_value', 
        'production_unit', 
        'production_duration', 
        'turnover', 
        'total_jobs', 
        'total_investment', 
        'strengths', 
        'weaknesses', 
        'financing_modes', 
        'investment_program', 
        'partnerships', 
        'contacts'
    ];

    /**
     * Custom function.
     *
     */
    public static function formFields() {

        $categories_options = [];
        $categories_sub_options = [];

        $categories = ProjectCategory::where('parent_id', NULL)->get();

        $categories->each(function ($category, $key) use(&$categories_options, &$categories_sub_options) {

            $sub_categories = ProjectCategory::where('parent_id', $category->id)->get();

            $categories_sub_options = [];

            foreach($sub_categories as $sub_category) {
                array_push($categories_sub_options, (object)[
                    'id' => $sub_category->id,
                    'title' => $sub_category->title,
                ]);
            }
            
            array_push($categories_options, (object)[
                'id' => $category->id,
                'title' => $category->title,
                'childs' => $categories_sub_options
            ]);
        });

        // return $categories_options;

        $townships_options = [];

        $townships = Township::all();

        foreach($townships as $township) {
            array_push($townships_options, (object)[
                'id' => $township->id,
                'title' => $township->title
            ]);
        }

        return [
            [
                'name' => 'category_id',
                'type' => 'select',
                'label' => 'Cat??gorie',
                'options' => $categories_options,
                'group' => 'Donn??es G??n??rales'
            ],
            [
                'name' => 'township_id',
                'type' => 'select',
                'label' => 'Commune',
                'options' => $townships_options,
                'group' => 'Donn??es G??n??rales'
            ],
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Titre',
                'group' => 'Donn??es G??n??rales'
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Description',
                'group' => 'Donn??es G??n??rales'
            ],
            [
                'name' => 'market_type',
                'type' => 'text',
                'label' => 'Type du march??',
                'group' => 'Donn??es G??n??rales'
            ],
            [
                'name' => 'holder_profile',
                'type' => 'text',
                'label' => 'Profil de porteur',
                'group' => 'Donn??es G??n??rales'
            ],
            [
                'name' => 'total_investment',
                'type' => 'text',
                'label' => 'Total investissement',
                'group' => 'Donn??es G??n??rales'
            ],
            [
                'name' => 'surface',
                'type' => 'text',
                'label' => 'Superficie',
                'group' => ''
            ],
            [
                'name' => 'production_value',
                'type' => 'text',
                'label' => 'Production (valeur)',
                'group' => 'Potentiel'
            ],
            [
                'name' => 'production_unit',
                'type' => 'text',
                'label' => 'Production (unit??)',
                'group' => 'Potentiel'
            ],
            [
                'name' => 'production_duration',
                'type' => 'text',
                'label' => 'Production (temps)',
                'group' => 'Potentiel'
            ],
            [
                'name' => 'turnover',
                'type' => 'text',
                'label' => 'Chiffre d\'affaires',
                'group' => 'Potentiel'
            ],
            [
                'name' => 'total_jobs',
                'type' => 'text',
                'label' => 'Nombre d\'emplois ?? cr??er',
                'group' => 'Potentiel'
            ],
            [
                'name' => 'strengths',
                'type' => 'repeater',
                'label' => 'Points forts',
                'group' => 'Points Forts & Faibles'
            ],
            [
                'name' => 'weaknesses',
                'type' => 'repeater',
                'label' => 'Points faibles',
                'group' => 'Points Forts & Faibles'
            ],
            [
                'name' => 'investment_program',
                'type' => 'repeater',
                'label' => 'Programme d\'Investissement',
                'group' => 'Programe d\'investissement',
                'config' => ['doubleRepeater' => true]
            ],
            [
                'name' => 'financing_modes',
                'type' => 'repeater',
                'label' => 'Donn??es Financi??res',
                'group' => 'Donn??es Financi??res',
                'config' => ['doubleRepeater' => true]
            ],
            [
                'name' => 'partnerships',
                'type' => 'textarea',
                'label' => 'Secteurs d\'appui & partenatiats',
                'group' => 'Autres Informations'
            ],
            [
                'name' => 'contacts',
                'type' => 'text',
                'label' => 'D??partements ?? contacter',
                'group' => 'Autres Informations'
            ],
            [
                'name' => 'equipment',
                'type' => 'textarea',
                'label' => '??quipements',
                'group' => 'Autres Informations'
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
