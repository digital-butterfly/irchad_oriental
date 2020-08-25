<?php

namespace App;
use App\ProjectCategory;
use App\Township;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class ProjectApplication extends Model
{
    protected $table = 'projects_applications';

    protected $guard = 'user';

    const LEGALFORM=['S.A.R.L','S.A','Coopérative'];
    const AIDEETAT=['INDH','DPA','Collectivités territoriales', 'Autre'];

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
        'market_type',
        'business_model',
        'financial_data',
        'training_needs',
        'company',
        'status',
        'progress',
        'training',
        'incorporation',
        'funding',
        'created_by',
        'rejected_reason',
        'updated_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
        'business_model'=> 'object',
        'financial_data'=> 'object',
        'training_needs'=> 'object',
        'company'=> 'object',
        'start_date' => 'datetime:d-m-Y',
        'end_date' => 'datetime:d-m-Y',


    ];

    /**
     * Custom function.
     *
     */
    public static function formFields($input) {

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

        $projectApplicationMembers = ProjectApplicationMember::where('project_application_id','=', $input)->get()->map(function($member){
            $user=$member->getUser ->only(['id','first_name','last_name']);
//            dd($user);
            return [
                'member_id'=>$user['id'],
                'value'=>$user['first_name'].' '. $user['last_name']
            ];
        });

        $membersession = AdherentSession::where('id_projet', $input)->get()->filter(function($member){
//            dd($member->getParentSession);
            $user=$member->getAdhname ->only(['id','first_name','last_name']);
            $sess= $member->getParentSession;

    return $sess->sort==='Terminée';

           });


       $membersess= $membersession->map(function($member){
            $user=$member->getAdhname;
            return [
                'member_id'=>$user['id'],
                'value'=>$user['first_name'].' '. $user['last_name']
            ];
});
        $membersessionAll = AdherentSession::where('id_projet', $input)->get()->map(function($members){

            $user=$members->getAdhname->only(['id','first_name','last_name']);
            return [
                'member_id'=>$user['id'],
                'value'=>$user['first_name'].' '. $user['last_name']
            ];
        });

$diff = $projectApplicationMembers->filter(function ($value1, $key) use ($membersess, $membersessionAll){
//    $exists = false;
    if ($membersess->isEmpty() && !$membersessionAll->isEmpty()){
        foreach ($membersessionAll as $value2){
            $exists=$value1['member_id']===$value2['member_id'];
        }
        return $exists;
    }else{
        return $value1;
    }
  })->values();


        return [
            [
                'name' => 'company',
                'type' => 'section',
                'class' => 'kt-callout--primary',
                'label' => 'Données Entreprise',
                "sub_fields" => [
                    [
                        'name' => 'is_created',
                        'type' => 'select',
                        'label' => 'Déja créée',
                        'options' => ['Oui', 'Non'],
                    ],
                    [
                        'name' => 'legal_form',
                        'type' => 'select',
                        'label' => 'Forme juridique',
                        'options' =>self::LEGALFORM

                    ],
                    [
                        'name' => 'capital',
                        'type' => 'text',
                        'label' => 'Capital social'
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
                    [
                        'name' => 'applied_tax',
                        'type' => 'select',
                        'label' => 'Type d\'impôt',
                        'options' => ['Impôt sur les sociétés', 'Impôt sur le revenu', 'Auto-entrepreneur activité commerciale, industrielle ou artisanale', 'Auto-entrepreneur prestataire de services'],
                    ],
                ],
                'group' => 'Données Entreprise'
            ],
            [
                'name' => 'member_id',
                'type' => 'text',
                'class' => 'kt-callout--dark',
                'label' => 'ID Adhérent',
                'group' => 'Données Générales'
            ],[
                'name' => 'members',
                'type' => 'taggify',
                'id'=>'kt_tagify_1',
                'class' => 'kt-callout--dark',
                'label' => 'noms sous Adhérent',
                'group' => 'Données Générales',
                'value'=> $projectApplicationMembers
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
                'name' => 'market_type',
                'type' => 'text',
                'label' => 'Type du marché',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'status',
                'type' => 'select',
                'label' => 'Status',
                'options' => ['Nouveau', 'Accepté','En cours', 'En attente de formation','En attente de financement', 'Rejeté','Business plan achevé', 'Incubé'],
                'group' => 'Données Générales'
            ],[
                'name' => 'rejected_reason',
                'type' => 'textarea',
                'style'=> 'display: none;',
                'label' => 'Motif de refus',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'progress',
                'type' => 'select',
                'label' => 'Progrès',
                'options' => ['Envoyé au Comité Technique', 'Accepté par le Comité Technique', 'Refusé par le Comité Technique','Envoyé au CPDH','Accepté par le CPDH','Refusé par le CPDH'],
                'group' => 'Données Générales'
            ],[
                'name' => 'training',
                'type' => 'select',
                'label' => 'Formation',
                'options' => ['Envoyé vers formation', 'Formé','Formation annulée'],
                'group' => 'Données Générales'
            ],[
                'name' => 'incorporation',
                'type' => 'select',
                'label' => 'Création',
                'options' => ['Entreprise en cours de création', 'Entreprise créee'],
                'group' => 'Données Générales'
            ],[
                'name' => 'funding',
                'type' => 'select',
                'label' => 'Financement',
                'options' => ['Envoyé au financement', 'Financement accepté','Financement refusé','Financé'],
                'group' => 'Données Générales'
            ],
            [
                'name' => 'business_model',
                'type' => 'text',
                'class' => 'kt-callout--success',
                'label' => 'Business Model',
                'sub_fields' => [
                    [
                        'name' => 'core_business',
                        'type' => 'textarea',
                        'label' => 'Produits et services'
                    ],
                    [
                        'name' => 'primary_target',
                        'type' => 'textarea',
                        'label' => 'Principaux clients'
                    ],
                    [
                        'name' => 'suppliers',
                        'type' => 'textarea',
                        'label' => 'Principaux fournisseurs'
                    ],
                    [
                        'name' => 'competition',
                        'type' => 'textarea',
                        'label' => 'Principaux concurrents'
                    ],
                    [
                        'name' => 'advertising',
                        'type' => 'textarea',
                        'label' => 'Marketing et publicité'
                    ],
                    [
                        'name' => 'pricing_strategy',
                        'type' => 'textarea',
                        'label' => 'Stratégie de prix'
                    ],
                    [
                        'name' => 'distribution_strategy',
                        'type' => 'textarea',
                        'label' => 'Stratégie de distribution'
                    ],
                ],
                'group' => 'Business Model',
            ],
            [
                'name' => 'financial_data',
                'type' => 'section',
                'class' => 'kt-callout--danger',
                'sub_fields' => [
                    [
                        'name' => 'startup_needs',
                        'type' => 'repeater',
                        'label' => 'Programme d\'investissement',
                        'config' => ['quadrupleRepeater' => true, 'attributes' => [['Désignation',3], ['Valeur',3], ['Taux',1], ['TVA',1]]]
                    ],
                    [
                        'name' => 'financial_plan',
                        'type' => 'repeater',
                        'label' => 'Plan de financement hors prêts',
                        'config' => ['doubleRepeater' => true]
                    ],
                    [
                        'name' => 'financial_plan_loans',
                        'type' => 'repeater',
                        'label' => 'Prêts',
                        'config' => ['quadrupleRepeater' => true]
                    ],
                    [
                        'name' => 'services_turnover_forecast',
                        'type' => 'text',
                        'label' => 'CA prévisionnel - Services'
                    ],
                    [
                        'name' => 'products_turnover_forecast',
                        'type' => 'text',
                        'label' => 'CA prévisionnel - Produits'
                    ],
                    [
                        'name' => 'profit_margin_rate',
                        'type' => 'text',
                        'label' => 'Taux de marge'
                    ],
                    [
                        'name' => 'evolution_rate',
                        'type' => 'text',
                        'label' => 'Taux d\'évolution annuelle'
                    ],
                    [
                        'name' => 'overheads_fixed',
                        'type' => 'repeater',
                        'label' => 'Charges annuelles constantes',
                        'config' => ['doubleRepeater' => true]
                    ],
                    [
                        'name' => 'overheads_scalable',
                        'type' => 'repeater',
                        'label' => 'Charges annuelles évolutives',
                        'config' => ['doubleRepeater' => true]
                    ],
                    [
                        'name' => 'human_ressources',
                        'type' => 'repeater',
                        'label' => 'Ressources humaines',
                        'config' => ['tripleRepeater' => true]
                    ],
                    [
                        'name' => 'taxes',
                        'type' => 'repeater',
                        'label' => 'Taxes',
                        'config' => ['doubleRepeater' => true]
                    ],
                ],
                'group' => 'Données Financières'
            ],
            [
                'class' => 'kt-callout--warning',
                'name' => 'training_needs',
                'type' => 'section',
                'sub_fields' => [
                    [
                        'name' => 'pre_creation_training',
                        'type' => 'repeater',
                        'label' => 'Besoins en pré-création'
                    ],
                    [
                        'name' => 'post_creation_training',
                        'type' => 'repeater',
                        'label' => 'Besoins en post-création'
                    ],
                ],
                'group' => 'Besoins en Formation',

            ],
            [
                'name' => 'id_formation',
                'type' => 'select',
                'label' => 'Formation',
                'options'=>[],
            ],
            [
                'name' => 'members-tagify',
                'type' => 'taggify',
                'id'=>'kt_tagify_2',
                'label' => 'noms sous Adhérent',
                'value'=> $diff
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
    public function getAdhname()
    {
        return $this->belongsTo('App\Member','member_id');
    }

}

