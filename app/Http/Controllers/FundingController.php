<?php

namespace App\Http\Controllers;

use App\Funding;
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
       if ($application->company->is_created=='Non'){
            $title=Incorporation::select('title')->where('id_projet',$request['id'])->get()->toArray();
           $application->inctitle=$title[0]['title'];
       }else{
           $application->inctitle=$application->company->corporate_name;
       }
        $total=0;
      if ($application->financial_data->startup_needs){
          foreach($application->financial_data->startup_needs as $item){
              $total+=(int)$item->value;

          };
          $application->total=$total; }





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
        dd($fundingIndh);
//        return redirect()->intended('admin/accountants');
    }


}
