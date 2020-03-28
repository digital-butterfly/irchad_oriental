<?php

namespace App;
use App\ProjectCategory;
use App\Township;

use Illuminate\Database\Eloquent\Model;

class ProjectSheet extends Model
{
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
        'financing_program', 
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
                'label' => 'Catégorie',
                'options' => $categories_options,
                'group' => 'Données Générales'
            ],
            [
                'name' => 'township_id',
                'type' => 'select',
                'label' => 'Commune',
                'options' => $townships_options,
                'group' => 'Données Générales'
            ],
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Titre',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Description',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'market_type',
                'type' => 'text',
                'label' => 'Type du marché',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'holder_profile',
                'type' => 'text',
                'label' => 'Profil de porteur',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'total_investment',
                'type' => 'text',
                'label' => 'Total investissement',
                'group' => 'Données Générales'
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
                'label' => 'Production (unité)',
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
                'label' => 'Nombre d\'emplois à créer',
                'group' => 'Potentiel'
            ],
            [
                'name' => 'strengths',
                'type' => 'text',
                'label' => 'Points forts',
                'group' => 'Points Forts & Faibles'
            ],
            [
                'name' => 'weaknesses',
                'type' => 'text',
                'label' => 'Points faibles',
                'group' => 'Points Forts & Faibles'
            ],
            [
                'name' => 'investment_program',
                'type' => 'text',
                'label' => 'Points faibles',
                'group' => 'Programe d\'investissement'
            ],
            [
                'name' => 'financing_modes',
                'type' => 'text',
                'label' => 'Points faibles',
                'group' => 'Données Financières'
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
                'label' => 'Départements à contacter',
                'group' => 'Autres Informations'
            ],
            [
                'name' => 'equipment',
                'type' => 'textarea',
                'label' => 'Équipements',
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
