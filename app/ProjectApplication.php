<?php

namespace App;
use App\ProjectCategory;
use App\Township;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Collection;
use phpDocumentor\Reflection\Types\This;

class ProjectApplication extends Model
{
    protected $table = 'projects_applications';

    protected $guard = 'user';

    const TAXES=['La taxe professionnelle','La taxe des services communaux','La taxe des véhicules','La taxe d’essieu pour les camions'];
    const INVEST=['Terrain', 'Construction', 'Aménagement', 'Matériel d’exploitation', 'Matériel bureautique', 'Matériel informatique', 'Matériel de transport','Frais preliminaires', 'Autre à préciser'];
    const LEGALFORM=['S.A.R.L','S.A.R.L A.U','S.N.C','Coopérative','A.E'];
    const AIDEETAT=['INDH','DPA','Collectivités territoriales', 'Autre'];
    const Etat=['Demande','Non demande','Delivre', 'Non delivre'];

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
        'montant_est',
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
        'updated_by',
        'credit_banc'
       
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
        $adhprc=ProjectApplication::where('id','=', $input)->get()->map(function($member){

            $user=$member->getAdhname->only(['id','first_name','last_name']);

            return [
                'member_id'=>$user['id'],
                'value'=>$user['first_name'].' '. $user['last_name'],

            ]; });
        $allmembers= $projectApplicationMembers;

        if (!empty($allmembers->toArray())) {
            $allmembers = $allmembers->merge($adhprc);
        }
        else{
            $allmembers =$adhprc;
        }
        $membersession = AdherentSession::all();


       $membersessdone= $membersession->where('id_projet', $input)->filter(function($member){
//
           $user=$member->getAdhname ->only(['id','first_name','last_name']);
           $sess= $member->getParentSession;
           return $sess->sort==='Terminée';
       })->map(function($member){
            $user=$member->getAdhname;
                return [
                    'member_id'=>$user['id'],
                    'value'=>$user['first_name'].' '. $user['last_name']
                        ];
            });
                    $membernotdone= $membersession->where('id_projet', $input)->filter(function($member){
                    //
                        $user=$member->getAdhname ->only(['id','first_name','last_name']);
                        $sess= $member->getParentSession;
                        return $sess->sort!='Terminée';
                    })->map(function($member){
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
        if (!$membernotdone->isEmpty()){

            foreach ($membernotdone as $key1=>$notdone){
                $selected = [];
                foreach ($allmembers as $key => $value) {
                    if ($value == $notdone) {
                        $selected[] = $value;
                        $allmembers->forget($key);
                    }
                }
        }
            $diff =$allmembers->values();
        }
        else{
            $diff =$allmembers->values();
        }

        return [
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
                'label' => 'Secteur d\'activité',
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
                'name' => 'montant_est',
                'type' => 'number',
                'label' => 'Montant d\'investissement estimatif',
                'group' => 'Données Générales'
            ], 
             [
                'name' => 'credit_banc',
                'type' => 'select',
                'label' => 'supplément crédit bancaire',
                'options'=>['Oui','Non'],
                'group' => 'Données Générales'
            ],
            [
                'name' => 'market_type',
                'type' => 'text',
                'label' => 'Marché visé',
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
                        'name' => 'implantation_project',
                        'type' => 'select',
                        'label' => 'Implantation du projet:',
                        'options' =>['Urbain','Rural']

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
                        'label' => 'Dénomination social'
                    ],[
                        'name' => 'corporate_CEO',
                        'type' => 'text',
                        'label' => 'Gérant de la société '
                    ],[
                        'name' => 'corporate_sig',
                        'type' => 'text',
                        'label' => 'Le siège sociale '
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
                'name' => 'business_model',
                'type' => 'section',
                'class' => 'kt-callout--success',
                'label' => 'Business Model',
                'sub_fields' => [
                    [
                        'name' => 'context_g',
                        'type' => 'textarea',
                        'label' => 'Contexte général'
                    ],
                    [
                        'name' => 'evolution_m',
                        'type' => 'textarea',
                        'label' => 'Evolutions de Marche'
                    ],
                    [
                        'name' => 'core_business',
                        'type' => 'text',
                        'label' => 'Produits ',
                    ],
                    [
                        'name' => 'core_business_p',
                        'type' => 'repeater',
                        'label' => 'Produits ',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Produit',3],['Description',4], ['Prix estime de vente',3]],'Select'=>false]
                    ],
                    [
                        'name' => 'core_services',
                        'type' => 'repeater',
                        'label' => 'Services ',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Service',3],['Description',4], ['Prix estime de vente',3]],'Select'=>false]
                    ],
                    [
                        'name' => 'primary_target',
                        'type' => 'text',
                        'label' => 'Principaux clients'
                    ],
                    [
                        'name' => 'suppliers',
                        'type' => 'text',
                        'label' => 'Principaux fournisseurs',

                    ],
                    [
                        'name' => 'competition',
                        'type' => 'text',
                        'label' => 'Principaux concurrents',

                    ],
                    [
                        'name' => 'primary_target_c',
                        'type' => 'repeater',
                        'label' => 'Principaux clients'
                    ],
                    [
                        'name' => 'suppliers_f',
                        'type' => 'repeater',
                        'label' => 'Principaux fournisseurs',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Fournisseur',3],['Nature des intrants',3], ['localité',2]],'Select'=>false]

                    ],
                    [
                        'name' => 'competition_c',
                        'type' => 'repeater',
                        'label' => 'Principaux concurrents',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Concurrent',3],['localité',3], ['Prix de vente',2]],'Select'=>false]

                    ],
                    [
                        'name' => 'avg_competi',
                        'type' => 'text',
                        'label' => 'Moyen de différenciation par rapport au concurrents'
                    ],
                    [
                        'name' => 'advertising',
                        'type' => 'textarea',
                        'label' => 'Stratégie  marketing et publicité'
                    ],
                    [
                        'name' => 'pricing_strategy',
                        'type' => 'select',
                        'label' => 'Stratégie de prix',
                        'options' => ['Écrémage', 'Alignement','Pénétration'],
                    ],
                    [
                        'name' => 'distribution_strategy',
                        'type' => 'textarea',
                        'label' => 'Stratégie de distribution'
                    ],
                    [
                        'name' => 'distribution_strategy_force',
                        'type' => 'text',
                        'label' => 'Force'
                    ],
                    [
                        'name' => 'distribution_strategy_menace',
                        'type' => 'text',
                        'label' => 'Menace'
                    ], 
                    [
                        'name' => 'distribution_strategy_faiblesse',
                        'type' => 'text',
                        'label' => 'Faiblesse'
                    ], 
                    [
                        'name' => 'distribution_strategy_Opportunité',
                        'type' => 'text',
                        'label' => 'Opportunité'
                    ], 
                    [
                        'name' => 'distribution_strategy_force_p',
                        'type' => 'repeater',
                        'label' => 'Force'
                    ],
                    [
                        'name' => 'distribution_strategy_menace_p',
                        'type' => 'repeater',
                        'label' => 'Menace'
                    ], 
                    [
                        'name' => 'distribution_strategy_faiblesse_p',
                        'type' => 'repeater',
                        'label' => 'Faiblesse'
                    ], 
                    [
                        'name' => 'distribution_strategy_Opportunité_p',
                        'type' => 'repeater',
                        'label' => 'Opportunité'
                    ], 
                    
                   
                   
                ],
                'group' => 'Étude De marché',
            ],
            
            [
                'name' => 'business_model',
                'type' => 'section',
                'class' => 'kt-callout--success',
                'label' => 'Business Model',
                'sub_fields' => [
                    [
                        'name' => 'autorisations_nécessaire',
                        'type' => 'repeater',
                        'label' => 'Autorisations nécessaires',
                    ],
                     [
                        'name' => 'autorisations_nécessaire_c',
                        'type' => 'repeater',
                        'label' => 'Autorisations nécessaires',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Nom Autorisation',3], ['Organisme ',2], ['Etat',4]],'Select'=>true, 'options' =>self::Etat],
                    ],
                    [
                        'name' => 'local',
                        'type' => 'repeater',
                        'label' => 'local',
                        'config' => ['quadrupleRepeater' => true, 'attributes' => [['Nature de l\'occupation',3], ['Prix de loyer ',2], ['Superficie  ',2], ['Adresse',0]],'Select'=>false]
                    ],
                    [
                        'name' => 'list_mat',
                        'type' => 'repeater',
                        'label' => 'liste de matériel'
                    ]
                    ],

                 'group' => 'Étude Technique',
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
                        'config' => ['quadrupleRepeater' => true, 'attributes' => [['Rubrique d\'investissement',3], ['Montant ',2], ['Taux d\'amortis',2], ['TVA',1]],'Select'=>true,'options'=>self::INVEST]
                    ],
                    [
                        'name' => 'financial_plan',
                        'type' => 'repeater',
                        'label' => 'Plan de financement hors prêts',
                        'config' => ['doubleRepeater' => true, 'attributes' => [['Rubrique de financement',4], ['Montant',2]],'Select'=>false]
                    ],
                    [
                        'name' => 'financial_plan_loans',
                        'type' => 'repeater',
                        'label' => 'Prêts',
                        'config' => ['quadrupleRepeater' => true, 'attributes' => [['Organisme de crédit',3], ['Montant',3], ['Taux',1], ['Durée  du prêts',3]],'Select'=>false]
                    ],
                    [
                        'name' => 'duration_différe',
                        'type' => 'number',
                        'label' => 'Durée  du différée'
                    ],
                    [
                        'name' => 'services_turnover_forecast_c',
                        'type' => 'repeater',
                        'label' => 'CA prévisionnel - Services',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Service',3], ['Quantité  vendus',3], ['P.U',3]],'Select'=>false]

                    ],
                    [
                        'name' => 'saisonnalite',
                        'type' => 'number',
                        'label' => 'Saisonnalité des ventes par mois'
                    ],
                    [
                        'name' => 'products_turnover_forecast',
                        'type' => 'repeater',
                        'label' => 'CA prévisionnel - Produits',
                        'config' => ['quadrupleRepeater' => true, 'attributes' => [['Produit',3], ['Quantité  vendus',3], ['P.U',3], ['Taux',1]],'Select'=>false]
                    ],
//                    [
//                        'name' => 'profit_margin_rate',
//                        'type' => 'text',
//                        'label' => 'Taux de marge'
//                    ],
                    [
                        'name' => 'evolution_rate',
                        'type' => 'text',
                        'label' => 'Taux d\'évolution annuelle'
                    ],
                    [
                        'name' => 'overheads_fixed',
                        'type' => 'repeater',
                        'label' => 'Charges annuelles constantes',
                        'config' => ['doubleRepeater' => true, 'attributes' => [['Intitulé de la charge',4], ['Montant ',3]],'Select'=>false]
                    ],
                    [
                        'name' => 'overheads_scalable',
                        'type' => 'repeater',
                        'label' => 'Charges annuelles évolutives',
                        'config' => ['doubleRepeater' => true, 'attributes' => [['Intitulé de la charge',4], ['Montant ',3]],'Select'=>false,]
                    ],
                    [
                        'name' => 'human_ressources',
                        'type' => 'repeater',
                        'label' => 'Ressources humaines',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Poste',3], ['Nombre des postes',3], ['Salaire  annuel',2]]]
                    ],
                    [
                        'name' => 'taxes',
                        'type' => 'repeater',
                        'label' => 'Taxes',
                        'config' => ['doubleRepeater' => true,'attributes' => [['Types de taxes',4], ['Montant ',3]],'Select'=>true, 'options' =>self::TAXES]
                    ],
                ],
                'group' => 'Étude Technique'
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
                'label' => 'list des inscrits',
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

