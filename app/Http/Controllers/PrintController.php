<?php

namespace App\Http\Controllers;
use App\Member;
use App\ProjectApplication;
use App\ProjectCategory;
use App\Township;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function Businessplan(Request $request,$id)
    {

         $townships = Township::all();
         $categories = ProjectCategory::all();

         $data = ProjectApplication::findOrFail($id);
         $members =$data->subMembers;
         $owner =$data->getAdhname;


        $township = $townships->filter(function ($value, $key) use( $data ) {
            
    return $value->id == $data->township_id;
})->first();
        $categories = $categories->filter(function ($value, $key) use( $data ) {
            
    return $value->id == $data->category_id;
})->first();

        foreach ($data as $key => $item) {
            json_decode($item) ? $data[$key] = json_decode($item) : NULL;
            if (is_object($data[$key])) {
                foreach ($data[$key] as $sub_key => $sub_item) {
                    is_object($sub_item) ? $data[$key]->$sub_key = json_decode($sub_item) : NULL;
                }
            }
        }

        $data = (object)$data;

        
        

                return view('back-office/templates/print-pdf/businessplan',compact('data','township','categories','owner','members'));

    }
}
