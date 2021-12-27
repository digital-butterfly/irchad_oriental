<?php

namespace App\Http\Controllers;
use App\Member;
use App\ProjectApplication;
use App\ProjectCategory;
use App\Township;
use Carbon\Carbon;
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
         $startup_needs=ProjectApplication::select('financial_data',ProjectApplication::raw('count(*) as total'))->groupBy('financial_data')->where('id', $id)->get();
         $startup_needarray=[];
         if(isset($startup_needs)){
           foreach ($startup_needs as $startup_need){
            if(isset($startup_need->financial_data->startup_needs )){
             foreach ($startup_need->financial_data->startup_needs as $startup_needd){    
              if(isset($startup_needd->label)){
              $arrytwer['name']=$startup_needd->label;
              $arrytwer['value']=1;  
               array_push($startup_needarray, $arrytwer);
              }  
            }
              
              
             // dd($startup_needd->label);
           
            }
           }   
         }
        
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

        
        

                return view('back-office/templates/print-pdf/businessplan',compact('data','township','categories','owner','members','startup_needarray'));

    }
}
