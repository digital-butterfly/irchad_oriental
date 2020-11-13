<?php

namespace App\Http\Controllers;

use App\Funding;
use App\FundingExterne;
use App\FundingIndh;
use App\Incorporation;
use App\Member;
use App\ProjectApplication;
use App\ProjectApplicationMember;
use App\ProjectCategory;
use App\Township;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class FundingController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application=$id;
        return view('back-office/templates/funding/single', compact('application'));
    }

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $fields = Funding::formFields();
        $application=ProjectApplication::findOrfail($request['id']);
        $adherent=Member::findOrFail($application->member_id);
        $application->adherent=is_object($adherent) == null ? "" : $adherent->first_name . ' ' . $adherent->last_name;
        $sousadherent=[];
        foreach (ProjectApplicationMember::select('member_id')->where('project_application_id',$request['id'])->get()->toarray() as $member){
            $sousadh =Member::findOrFail($member['member_id'])->only('first_name','last_name');
            array_push( $sousadherent,$sousadh);
        }
        $application->sousadherent=$sousadherent;


        $category=ProjectCategory::findOrFail($application->category_id);
        $application->category= $category->title;

        $township=Township::findOrFail($application->township_id);
        $application->township= $township->title;
        $inc= Incorporation::where('id_projet',$request['id']);
       if ($application->company->is_created=='Non' && $inc->exists() ){

            $title=$inc->select('title')->get()->toArray();
           $application->inctitle=$title[0]['title'];
       }else{
           $application->inctitle=$application->company->corporate_name;
       }
        $total=0;
//       dd($application->financial_data);
      if ($application->financial_data->startup_needs){
          foreach($application->financial_data->startup_needs as $item){
              $total+=(int)$item->value;

          };
          $application->total=$total; }
        $funding=FundingIndh::where('id_projet',$request['id']);
        $fundingext=FundingExterne::where('id_projet',$request['id']);
        $application->funding= $funding->get();
        $application->fundingext= $fundingext->get();
        $application->found=  $funding->exists();
        $application->foundext=  $fundingext->exists();

//      dd($application);


//        dd(($application->financial_data));
        return view('back-office/templates/funding/add', compact("fields",'application'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fundingIndh = FundingIndh::updateOrCreate([
            'status_indh'=>$request['status_indh'],
            'date_prise_charge'=>$request['date_prise_charge'],
            'id_projet'=>$request['project_id']
        ]);
        if ($request['status_indh']==='Prêt pour envoi au CT'){
//            dd($fundingIndh->id);
            FundingIndh::find($fundingIndh->id)  ->update([
                'ready_cpdh'=>1,
            ]);
//            dd($fundingIndh);
        }
//        dd($fundingIndh);
        return redirect()->intended('admin/funding-indh');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param FundingIndh $fundingIndh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        dd($request->toArray());
        $fundingIndh= FundingIndh::where("id_projet",$request['project_id'])->get();
        $fundingIndh[0]->update([
            'status_indh'=>$request['status_indh'],
            'date_prise_charge'=>$request['date_prise_charge'],
            'id_projet'=>$request['project_id']

        ]);
        return redirect()->intended('admin/funding-indh/');
    }


}
