<?php

namespace App;
use App\ProjectCategory;
use App\Township;

use Illuminate\Database\Eloquent\Model;

class ProjectApplication extends Model
{
    protected $table = 'projects_applications';

    protected $guard = 'user';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id', 
        'category_id', 
        'township_id', 
        'sheet_id', 
        'title', 
        'description', 
        'business_model', 
        'financial_data', 
        'company',
        'status'
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
                'name' => 'member_id',
                'type' => 'text',
                'label' => 'ID Adhérent',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'category_id',
                'type' => 'select',
                'label' => 'Catégorie du projet',
                'options' => $categories_options,
                'group' => 'Données Générales'
            ],
            [
                'name' => 'township_id',
                'type' => 'select',
                'label' => 'Commune du projet',
                'options' => $townships_options,
                'group' => 'Données Générales'
            ],
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Titre du projet',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'description',
                'type' => 'textarea',
                'label' => 'Description du projet',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'business_model',
                'type' => 'text',
                'label' => 'Business Model',
                'group' => 'Business Model'
            ],
            [
                'name' => 'financial_data',
                'type' => 'text',
                'label' => 'Données Financières',
                'group' => 'Données Financières'
            ],
            [
                'name' => 'company',
                'type' => 'section',
                'label' => 'Données Entreprise',
                "sub_fields" => [
                    [
                        'name' => 'legal_form',
                        'type' => 'text',
                        'label' => 'Forme juridique'
                    ],
                    [
                        'name' => 'is_created',
                        'type' => 'select',
                        'label' => 'Déja créée',
                        'options' => ['Oui', 'Non'],
                    ],
                    [
                        'name' => 'creation_date',
                        'type' => 'date',
                        'label' => 'Date de création'
                    ],
                    [
                        'name' => 'corporate_name',
                        'type' => 'text',
                        'label' => 'Dénomination sociale'
                    ],
                ],
                'group' => 'Données Entreprise'
            ],
            [
                'name' => 'status',
                'type' => 'select',
                'label' => 'Status',
                'options' => ['Nouveau', 'Validé', 'Rejeté', 'Incubé'],
                'group' => 'Données Générales'
            ],
        ];
    }

    /**
     * Get the projects sheets associated with the township.
     */
    /* public function projects_sheets()
    {
        return $this->hasMany('App\ProjectApplication');
    } */
}
