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

    const TAXES=['Taxe professionnelle','Taxe speciale sur véhicules','Taxe de promotion touristique'];
    const INVEST=[ 'Frais preliminaires', ' Immobilisations Incorporelle ','Terrain','Construction et / ou Aménagement', 'Mobilier et Matériel de bureau', 'Matériel et Outillage','Matériel informatique', 'Matériel de transport', 'Matériel de manutention ',  'Fonds de roulement de démarrage','Autre à préciser'];
    const LEGALFORM=['S.A.R.L','S.A.R.L A.U','S.N.C','Coopérative','A.E'];
    const AIDEETAT=['INDH','DPA','Collectivités territoriales', 'Autre'];
    const Etat=['Demande','Non demande','Delivre', 'Non delivre'];
    const Rubr=['Apport Personnel','Subvention INDH','Apport en Numéraire ', 'Apport en Nature'];

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
        'company_arab',
        'status',
        'progress',
        'training',
        'incorporation',
        'funding',
        'created_by',
        'rejected_reason',
        'updated_by',
        'credit_banc',
        'list_mat_file',
        'business_model_arab'
        
       
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
        'company_arab'=> 'object',
        'business_model_arab'=> 'object',
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
            ],
        [
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
                'label' => 'lieu du projet',
                'options' => $townships_options,
                'group' => 'Données Générales'
            ],
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Intitule du projet',
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
                'label' => 'Montant estimatif de l\'investissement',
                'group' => 'Données Générales'
            ], 
            [
                'name' => 'credit_banc',
                'type' => 'select',
                'label' => 'complément crédit bancaire',
                'options'=>['Oui','Non'],
                'group' => 'Données Générales'
            ],
            [
                'name' => 'market_type',
                'type' => 'text',
                'label' => 'Marché cible',
                'group' => 'Données Générales'
            ],
            [
                'name' => 'status',
                'type' => 'select',
                'label' => 'Statut Du PDP',
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
                        'label' => 'Dénomination sociale'
                    ],[
                        'name' => 'corporate_CEO',
                        'type' => 'text',
                        'label' => 'Gérant de la société '
                    ],[
                        'name' => 'corporate_sig',
                        'type' => 'text',
                        'label' => 'Siège social '
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
              'name' => 'company_arab',
                'type' => 'section',
                'class' => 'kt-callout--dark text-right',
                'label' => 'تقديم حامل المشروع',
                "sub_fields" => [
                    [
                        'name' => 'nom_arabe',
                        'type' => 'text',
                        'label' => 'اسم الكامل',
                        'class' => 'text-right',

                    ],
                           [
                        'name' => 'activite_arabe',
                        'type' => 'text',
                        'label' => 'القطاع'

                    ],
                           [
                        'name' => 'desc_projet_arabe',
                        'type' => 'text',
                        'label' => 'وصف المشروع'

                    ],
                           [
                        'name' => 'desc_porteur_arabe',
                        'type' => 'textarea',
                        'label' => 'تقديم حامل المشروع'

                    ],
                ],
                'group' =>'donne_general_arab'
            ],
            [
              'name' => 'company_arab',
                'type' => 'section',
                'class' => 'kt-callout--primary ',
                'label' => 'تقديم المشروع',
                "sub_fields" => [
                    [
                        'name' => 'legal_form_arabe',
                        'type' => 'text',
                        'label' => 'الشكل القانوني'

                    ],
                    [
                        'name' => 'implantation_arabe',
                        'type' => 'text',
                        'label' => 'توطين المقاولة  '
                    ],
                    [
                        'name' => 'produit_service_arabe',
                        'type' => 'repeater',
                        'label' => 'المنتوج أو الخدمة  '
                    ],
                ],
                'group' =>'entreprise_arab'
            ],
            [
              'name' => 'business_model_arab',
                'type' => 'section',
                'class' => 'kt-callout--danger',
                'label' => 'دراسة السوق',
                "sub_fields" => [
                    [
                        'name' => 'fournisseur_arabe',
                        'type' => 'repeater',
                        'label' => 'الموردون'

                    ],
                    [
                        'name' => 'client_arabe',
                        'type' => 'repeater',
                        'label' => ' الزبناء '
                    ],
                    [
                        'name' => 'concurent_arabe',
                        'type' => 'repeater',
                        'label' => 'المنافسون  '
                    ],
                       [
                        'name' => 'autorisation_arabe',
                        'type' => 'repeater',
                        'label' => 'الرخص الإدارية اللازمة'
                    ],
                ],
                'group' =>'etude_marche_arab'
            ],
            [
              'name' => 'business_model_arab',
                'type' => 'section',
                'class' => 'kt-callout--warning',
                'label' => 'الدراسة التقنية للمشروع',
                "sub_fields" => [
                    [
                        'name' => 'list_mat_arabe',
                        'type' => 'repeater',
                        'label' => 'لوازم و أدوات الاشتغال'
                    ],
                    [
                        'name' => 'local_arabe',
                        'type' => 'repeater',
                        'label' => ' كراء مقر المشروع  ',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['الموقع',3],['المساحة',4], ['سومةالكراء',3]],'Select'=>false]
                    ]
                ],
                'group' =>'etude_technique_arab'
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
                        'label' => 'Evolutions du Marche'
                    ],
                    [
                        'name' => 'core_business_p',
                        'type' => 'repeater',
                        'label' => 'Produits ',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Produit',3],['Description',4], ['Prix de vente estimatif',3]],'Select'=>false]
                    ],
                    [
                        'name' => 'core_services',
                        'type' => 'repeater',
                        'label' => 'Services ',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Service',3],['Description',4], ['Prix de la prestation',3]],'Select'=>false]
                    ],
                    [
                        'name' => 'primary_target_c',
                        'type' => 'repeater',
                        'label' => 'Principaux clients'
                    ],
                     [
                        'name' => 'primary_target_client_d',
                        'type' => 'repeater',
                        'label' => 'Details client',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['client',3],['Produit/Service',3], ['Marché ',2]],'Select'=>false]

                    ],
                    [
                        'name' => 'suppliers_f',
                        'type' => 'repeater',
                        'label' => 'Principaux fournisseurs',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Fournisseur',3],['Nature des intrants',3], ['ville/pays',2]],'Select'=>false]

                    ],
                    [
                        'name' => 'competition_c',
                        'type' => 'repeater',
                        'label' => 'Principaux concurrents',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Concurrent',3],['Produit/Service',3], ['ville/pays',2]],'Select'=>false]

                    ],
                    [
                        'name' => 'avg_competi',
                        'type' => 'textarea',
                        'label' => 'Critéres de différenciation par rapport au concurrents'
                    ],
                    [
                        'name' => 'advertising',
                        'type' => 'textarea',
                        'label' => 'Stratégie  marketing et Comerciale'
                    ],
                    [
                        'name' => 'pricing_strategy',
                        'type' => 'select',
                        'label' => 'Stratégie de prix',
                        'options' => ['Écrémage', 'Alignement','Pénétration'],
                    ],
                     [
                        'name' => 'pricing_strategy_disc',
                        'type' => 'textarea',
                        'label' => 'Description  de la stratégie de prix',
                       
                    ],
                    [
                        'name' => 'distribution_strategy',
                        'type' => 'textarea',
                        'label' => 'Stratégie de distribution'
                    ],
                    [
                        'name' => 'distribution_strategy_force_p',
                        'type' => 'repeater',
                        'label' => 'Forces'
                    ],
                   
                    [
                        'name' => 'distribution_strategy_faiblesse_p',
                        'type' => 'repeater',
                        'label' => 'Faiblesses'
                    ], 
                    [
                        'name' => 'distribution_strategy_Opportunité_p',
                        'type' => 'repeater',
                        'label' => 'Opportunités'
                    ], 
                     [
                        'name' => 'distribution_strategy_menace_p',
                        'type' => 'repeater',
                        'label' => 'Menaces'
                    ], 
                   
                   
                ],
                'group' => 'Étude du marché',
            ],
            
            [
                'name' => 'business_model',
                'type' => 'section',
                'class' => 'kt-callout--success',
                'label' => 'Business Model',
                'sub_fields' => [
                   
                     [
                        'name' => 'autorisations_nécessaire_c',
                        'type' => 'repeater',
                        'label' => 'Autorisations nécessaires',
                        'config' => ['tripleRepeater' => true, 'attributes' => [['Type d\'Autorisation',4], ['Établissement',4], ['Statut',3]],'Select'=>true, 'options' =>self::Etat],
                    ],
                    [
                        'name' => 'local',
                        'type' => 'repeater',
                        'label' => 'local',
                        'config' => ['quadrupleRepeater' => true, 'attributes' => [['Mode d\'occupation',3], ['Adresse ',2], ['Superficie  ',2], ['Loyer',0]],'Select'=>false]
                    ],
                    [
                        'name' => 'list_mat',
                        'type' => 'repeater',
                        'label' => 'liste du matériel'
                    ]
                    ],

                 'group' => 'Étude Technique',
             ],
             [
                'name' => 'list_mat_file',
                'type' => 'file',
                'label' => 'fichier de liste  du matériel ',
                'group' => 'Étude Technique'
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
                        'name' => 'total_invest',
                        'type' => 'text',
                        'label' => 'Total du Programme d\'investissement'
                    ],
                    [
                        'name' => 'financial_plan',
                        'type' => 'repeater',
                        'label' => 'Plan de financement hors crédit',
                        'config' => ['doubleRepeater' => true, 'attributes' => [['Rubrique de financement',4], ['Montant',2]],'Select'=>true,'options'=>self::Rubr]
                    ],
                    [
                        'name' => 'financial_plan_loans',
                        'type' => 'repeater',
                        'label' => 'Prêts',
                        'config' => ['quadrupleRepeater' => true, 'attributes' => [['Organisme de crédit',3], ['Montant',3], ['Taux d\'intérêts',3], ['Durée  du prêt en année',3]],'Select'=>false]
                    ], 
                     [
                        'name' => 'duration_différe',
                        'type' => 'number',
                        'label' => 'Durée  du différé (en mois)'
                    ],
                      [
                        'name' => 'total_plan',
                        'type' => 'text',
                        'label' => 'Total  Plan de financement '
                    ],
                    
                      
                ],
            'group' => 'Étude Technique'
          ],
            [
                'name' => 'financial_data',
                'type' => 'section',
                'class' => 'kt-callout--danger' ,
                'sub_fields' => [
                     [
                        'name' => 'evolution_rate',
                        'type' => 'text',
                        'label' => 'Taux d\'évolution annuelle'
                    ],
                    [
                        'name' => 'services_turnover_forecast_c',
                        'type' => 'repeater',
                        'label' => 'CA prévisionnel - Services',
                        'config' => ['sextupleRepeater' => true, 'attributes' => [['Service',3], ['Quantité/Nombre(par mois)',4], ['Prix',2],['Taux de marge',3],['Chiffre d\'affaires mensuel',4],['Saisonnalité(en mois)',3]],'Select'=>false]

                    ],
                    [
                        'name' => 'products_turnover_forecast',
                        'type' => 'repeater',
                        'label' => 'CA prévisionnel - Produits',
                        'config' => ['sextupleRepeater' => true, 'attributes' => [['Produit',3], ['Quantité/Nombre(par mois)',4], ['Prix unitaire',2], ['Taux de marge',3],['Chiffre d\'affaires mensuerl',3],['Saisonnalité(en mois)',3],],'Select'=>false]
                    ],
                        [
                        'name' => 'ca_produit-service',
                        'type' => 'text',
                        'label' => 'Chiffre d\'affaires annuel'
                    ],    
                      [
                        'name' => 'saisonnalite',
                        'type' => 'number',
                        'label' => 'Durée d\'activite '
                    ], 
                    
                    [
                        'name' => 'overheads_fixed',
                        'type' => 'repeater',
                        'label' => 'Charges fixes',
                        'config' => ['AddDoubleRepeater' => true, 'attributes' => [['Nature de la charge',4], ['Montant',4],[' Mensuel/Annuel',3]],'Select'=>true,'options'=>['Mensuel','Annuel']]
                    ],
                    [
                        'name' => 'overheads_scalable',
                        'type' => 'repeater',
                        'label' => 'Charges variables',
                      'config' => ['AddDoubleRepeater' => true, 'attributes' => [['Nature de la charge',4], ['Montant',4],[' Mensuel/Annuel',3]],'Select'=>true,'options'=>['Mensuel','Annuel']]
                    ],
                    [
                        'name' => 'human_ressources',
                        'type' => 'repeater',
                        'label' => 'Ressources humaines',
                        'config' => ['quadrupleRepeater' => true, 'attributes' => [['Fonction',3], ['Nombre',2], ['Salaire Mensuel',3], ['Durée de travail (en mois)',3]],'Select'=>false]
                    ],
                    [
                        'name' => 'taxes',
                        'type' => 'repeater',
                        'label' => 'Impôts et Taxes',
                        'config' => ['doubleRepeater' => true,'attributes' => [['Types de taxes ',4], ['Montant ',3]],'Select'=>true, 'options' =>self::TAXES]
                    ],
                ],
                'group' => 'Prévision'
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

