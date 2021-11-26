<?php

namespace App\Http\Controllers;

use App\ExcelPerSheet;
use App\ProjectApplicationMember;
use App\ProjectCategory;
use App\Township;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Member;
use App\ProjectApplication;
use Maatwebsite\Excel\Facades\Excel;

use \App\Mail\WelcomeMail;
use \Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CandidatureController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param  string  $type
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $type)
    {
        if($type == 'member')
        {
//            dd($data);

                return Validator::make($data, [
                    'first_name.*' => ['required', 'string', 'max:255'],
                    'last_name.*' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:members,email'],
                    'identity_number' => ['required', 'string', 'max:255', 'unique:members,identity_number']
                ]);




        }else if( $type == 'projectApplication')
        {
            return Validator::make($data, [
                'township_id' => ['nullable', 'integer', 'exists:townships,id'],
                'title' => ['required', 'string', 'max:155'],
                'market_type' => ['nullable', 'string', 'max:155'],
                'startup_needs.rate'=>['nullable', 'integer']
            ]);
        }

    }

    public function create(Request $request)
    {
        $verification = false;
//        dd($request->toArray());
//        dd(isset($request['degrees']));
        //validation
       foreach ( $request->all()['member'] as $datamember){
           $validation =  $this->validator($datamember, 'member');
           $verification = $validation==true?$validation:$validation;

       }

//        dd($validation->fails());
        if($verification->fails())
        {
            //return redirect()->back()->withErrors($validation)->withInput();
            return response()->json(array(
                'success' => false,
                'errors' => $validation->getMessageBag()->toArray()

            ), 400); // 400 being the HTTP code for an invalid request.
        }
        $validation = $this->validator($request->all(), 'projectApplication');
        if($validation->fails())
        {
            return response()->json(array(
                'success' => false,
                'errors' => $validation->getMessageBag()->toArray()

            ), 400); // 400 being the HTTP code for an invalid request.
        }
        $degrees = array();
        $expericances = array();
        $statehelp = array();
        $company = array();
        $memarray = array();
        foreach ($request['member'] as $item){
//            dd($item);
//            dd($item['birth_date']);
            if(isset($item['degrees']))
            {
                foreach($item['degrees'] as $degree)
                {
                    if (!$this->input_is_null($degree)) {

                        //var_dump($degree["'annee'"]);die;
                        $degrees [] = array(
//                "label" => $degree["diplome_type"].','.$degree["etablissement"],
                            "label" => $degree["diplome_type"],
                            "value"=>$degree["etablissement"],
                            'count' => $degree["annee"]
                        );}

                }
            }

            if (isset($item['professional_experience'])) {
                foreach ($item['professional_experience'] as $exp) {
                    if (!$this->input_is_null($exp)) {
                        $expericances [] = array(
                            "label" => $exp["label"],
                            "value" => $exp["value"],
                            "rate" => $exp["rate"],
                            "duration" => $exp["duration"],
                            "organisme" => $exp["organisme"],
//                        "label" => $exp["du"].'-'.$exp["au"],
//                        'value' => $exp["poste"].' ' .$exp["mission"].' chez '. $exp['organisme']
                        );
                    }

                }
            }


//        dd(isset($request['statehelp'][0]['aide_date']));

        if(isset($request['statehelp'][0]['aide_date']))
        {
            foreach($request['statehelp'] as $state)
            {
        if (!$this->input_is_null($state)){


                $statehelp [] = array(
                    "label" => $state["aid-oui"],
                    "value" => $state["aide_date"],
                    'count' => $state["aide_montant"]
                );
            } else{
            $statehelp = null;

        }
            }

        }
//dd($statehelp);

        if(isset($request['company']))
        {
            $is_created = "Non";
            if(isset($request['company']["is_created"]))
            {
                $is_created = $request['company']["is_created"] == 1 ? "Oui" : "Non";
            }
            $company = array(
                'capitale' => "",
                "is_created" => $is_created,
                "legal_form" => isset($request['company']["legal_form"]) ? $request['company']["legal_form"] : NULL,
                "corporate_name" => $request['company']["corporate_name"],
                "creation_date" => $request['company']["creation_date"],
            );
        }

            $otherquestions [] = array(
                "chomage" => isset ($item["chomage"])?$item["chomage"]:null,
                "chomage_desc" => isset ($item["chomage_desc"])? $item["chomage_desc"]:null,
                "informal_activity_desc" => isset ($item["informal_activity_desc"])?$item["informal_activity_desc"]:null,
                "informal_activity" => isset ($item["informal_activity"])?$item["informal_activity"]:null,
                "entre_activity" => isset ($item["entre_activity"])?$item["entre_activity"]:null,
                "entre_activity_desc" => isset ($item["entre_activity_desc"])?$item["entre_activity_desc"]:null,
                "project_idea" => isset ($item["project_idea"])?$item["project_idea"]:null,
                "project_idea_desc" => isset ($item["project_idea_desc"])?$item["project_idea_desc"]:null,
                "formation_needs" => isset ($item["formation_needs"])?$item["formation_needs"]:null,
                "formation_needs_desc" => isset ($item["formation_needs_desc"])?$item["formation_needs_desc"]:null,
                "entre_activity_nat" => isset ($item["entre_activity_nat"])?$item["entre_activity_nat"]:null,
                "informal_activity_nat" => isset ($item["informal_activity_nat"])?$item["informal_activity_nat"]:null,



            );



            $gender = $item['civility'] == 0 ? 'Homme' : 'Femme';
//            dd($gender);
            $today=Carbon::now()->toDateString();

//            dd($today);

//            $eligibale= Carbon::createFromFormat('Y-m-d', );
            $diff = abs(strtotime($today) - strtotime($item['birth_date']));
            $years=floor($diff / (365*60*60*24));
            $months =floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days= $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));



//

        //inserstion Of member
//        dd((json_encode($otherquestions)));

        $password=Str::random(8);
        $member = Member::create([
            'first_name' => strtolower($item['first_name']),
            'last_name' => strtolower($item['last_name']),
            'email' => $item['email'],
            'identity_number' => $item['identity_number'],
            'phone' => $item['phone'],
            'birth_date' => $item['birth_date'],
            'gender'=>$gender,
            'address' => $item['address'],
            'password'=>Hash::make($password),
            'township_id' => $item['township_id'],
            'degrees' => json_decode(json_encode($degrees)),
            'professional_experience' => json_decode(json_encode($expericances)),
            'state_help' => json_decode(json_encode($statehelp)),
            'reduced_mobility' => $item['reduced_mobility'],
            'otherquestions' => (json_encode($otherquestions)),

        ]);
            $user = [
                'email' => $member->email,
                'password' => $password,
                'first_name'=>$member->first_name
            ];
            Mail::to($member->email)->send(new WelcomeMail($user));

            array_push($memarray, $member->id);
        }

        $application = ProjectApplication::create([
            'member_id' => $memarray[0],
            'township_id' => $member->township_id,
            'title' => $request['title'],
            'description' => $request['description'],
            'market_type' => $request['market_type'],
            'category_id' => $request['category_id'],
            'training_needs'=> json_decode('{"pre_creation_training": [{"pre_creation_training": null}], "post_creation_training": [{"post_creation_training": null}]}'),
            'financial_data'=>json_decode('{"taxes": [{"label": null, "value": null}], "startup_needs": [{"rate": null, "label": null, "value": null, "duration": null}], "evolution_rate": null, "financial_plan": [{"label": null, "value": null}], "overheads_fixed": [{"label": null, "value": null}], "human_ressources": [{"count": null, "label": null, "value": null}], "overheads_scalable": [{"label": null, "value": null}], "profit_margin_rate": null, "financial_plan_loans": [{"rate": null, "label": null, "value": null, "duration": null}], "products_turnover_forecast": [{"rate": null, "label": null, "value": null, "duration": null}], "services_turnover_forecast": null}'),
            'business_model'=>json_decode('{"suppliers": null, "advertising": null, "competition": null, "core_business": null, "primary_target": null, "pricing_strategy": null, "distribution_strategy": null}'),

//            'created_by' => 0,

            'company' =>  json_decode(json_encode($company)),
        ]);
        if (count($memarray)>1){
            foreach ($memarray as $key=>$value){
                if ($key>0){
                    $projectappmembers=ProjectApplicationMember::create([
                        'member_id' => $value,
                        'project_application_id' => $application->id,]);
                }

            }

        }

//        dd($application);

        if ($years>=18 && $years<=45){
            return response()->json(['message'=> 'Projet submited'],200);
        }
        else{
            $member->update([
                'status' => 'Rejeté',
            ]);
            return response()->json(['message'=> 'Nous tenons à vous informer que nous ne pouvons malheureusement pas donner suite à votre inscription pour le motif suivant : votre âge n’est pas éligible pour ce programme. Votre dossier sera toujours actif, dans l’attente de lancement d’un nouveau programme.'],200);
        }


    }

    public function index(){

        $sectors=ProjectCategory::all()->where('parent_id','=',null);
        $subSectors=ProjectCategory::all()->where('parent_id','!=',null);
        foreach ($sectors as $sector){
            $sector->subSectors=collect();
            foreach ($subSectors as $subSector){
                if ($sector['id']==$subSector['parent_id']){
                    $sector->subSectors->push($subSector);
                }
            }
        }
        $LEGALFORM=ProjectApplication::LEGALFORM;
        $AIDEETAT=ProjectApplication::AIDEETAT;
        $Communes =Township::all();

        return view('front-office.candidature',compact("sectors","LEGALFORM", 'AIDEETAT','Communes'));


    }

    /**
     * Check if Member experience is null.
     *
     * @param  array  $exp
     * @return boolean
     */
    private function input_is_null($data) {
        $exp_is_null = false;

        for ($i = 1; $i >=  sizeof($data); $i++) {
            $data[i] != NULL ? $exp_is_null == true : NULL;
        }

        return $exp_is_null;
    }



}

