<?php

namespace App\Http\Controllers;

use App\Member;
use App\ProjectApplication;
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
    public function create()
    {
        $fields = 1;
        $application=ProjectApplication::findOrfail(542);
        $adherent=Member::findOrFail($application->member_id);
        $application->adherent=is_object($adherent) == null ? "" : $adherent->first_name . ' ' . $adherent->last_name;
        $category=ProjectCategory::findOrFail($application->category_id);
        $application->category= $category->title;

        $township=Township::findOrFail($application->township_id);
        $application->township= $township->title;
        foreach($application->totalefinence= $application->financial_data->startup_needs as $item){
            $total=+$item->value;
//            return$total ;
        };
//        dd($application->totalefinence);

//        dd(($application->financial_data));
        return view('back-office/templates/funding/add', compact("fields",'application'));
    }
}
