<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Member;
use App\ProjectApplication;

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
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            ]);
        }else if( $type == 'projectApplication')
        {
            return Validator::make($data, [
                'township_id' => ['nullable', 'integer', 'exists:townships,id'],
                'title' => ['required', 'string', 'max:155'],
                'market_type' => ['nullable', 'string', 'max:155'],
            ]);
        }
        
    }

    public function create(Request $request)
    {
        //validation 
        $validation =  $this->validator($request->all(), 'member');
        if($validation->fails())
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
        foreach($request['degrees'] as $degree)
        {
            //var_dump($degree["'annee'"]);die;
           $degrees [] = array(
            "label" => $degree["diplome_type"].','.$degree["etablissement"],
            'annee' => $degree["annee"]
           );
        }
        $expericances = array();
        foreach($request['professional_experience'] as $exp)
        {
        
           $expericances [] = array(
            "label" => $exp["du"].'-'.$exp["au"],
            'annee' => $exp["poste"].' ' .$exp["mission"].' chez '. $exp['organisme']
           );
        }
        $company = array();
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
                "legal_form" => $request['company']["legal_form"],
                "corporate_name" => $request['company']["corporate_name"],
                "creation_date" => $request['company']["creation_date"],
            );  
        }
        
        $gender = $request['civility'] == 0 ? 'Homme' : 'Femme';
        
        //inserstion Of member
        $member = Member::create([
            'first_name' => strtolower($request['first_name']),
            'last_name' => strtolower($request['last_name']),
            'email' => $request['email'],
            'identity_number' => $request['identity_number'],
            'phone' => $request['phone'],
            'birth_date' => $request['birth_date'],
            'address' => $request['address'],
            'township_id' => $request['township_id'],
            'degrees' => json_encode($degrees),
            'professional_experience' => json_encode($expericances),
            'reduced_mobility' => $request['reduced_mobility'],
        ]);
        $application = ProjectApplication::create([
            'member_id' => $member->id, 
            'township_id' => $request['township_id'], 
            'title' => $request['title'], 
            'description' => $request['description'], 
            'market_type' => $request['market_type'], 
            'company' => json_decode(json_encode($company)),
        ]);
        return response()->json(['message'=> 'Projet submited'],200);
    }
}
