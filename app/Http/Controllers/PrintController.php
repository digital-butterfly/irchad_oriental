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
         $parent_category = ProjectCategory::all();
         $data = ProjectApplication::findOrFail($id);
         $members =$data->subMembers;
         //dd( $members);
         $owner =$data->getAdhname;
         $startup_needs=ProjectApplication::select('financial_data',ProjectApplication::raw('count(*) as total'))->groupBy('financial_data')->where('id', $id)->get();
         $startup_needarray=[];
         $total_startupneeds=0;
         if(isset($startup_needs)){
         foreach ($startup_needs as $startup_need){
         if(isset($startup_need->financial_data->startup_needs )){
             foreach ($startup_need->financial_data->startup_needs as $startup_needd){
             $total_startupneeds+= $startup_needd->value;
         }}}}
         //dd($total_startupneeds);
         if(isset($startup_needs)){
           foreach ($startup_needs as $startup_need){
            if(isset($startup_need->financial_data->startup_needs )){
             foreach ($startup_need->financial_data->startup_needs as $startup_needd){
              if(isset($startup_needd->labelOther)){

               $arrytwer['name']=$startup_needd->labelOther;
               $arrytwer['value']= number_format($total_startupneeds!=0?$startup_needd->value/$total_startupneeds*100:0,0, ',', ' ');
               array_push($startup_needarray, $arrytwer);

              }elseif(isset($startup_needd->label)){

              $arrytwer['name']=$startup_needd->label;
              $arrytwer['value']= number_format($total_startupneeds!=0?$startup_needd->value/$total_startupneeds*100:0,0, ',', ' ');
               array_push($startup_needarray, $arrytwer);
              }
            }
            }
           }
         }

        $township = $townships->filter(function ($value, $key) use( $data ) {

    return $value->id == $data->township_id;
})->first();
        $categories = $categories->filter(function ($value, $key) use( $data ) {

    return $value->id == $data->category_id;
})->first();
// $parent_category = $categories->filter(function ($value, $key) use( $data ) {

//     $cat=ProjectCategory::find($data->category_id);
//     return $value->id == $cat->parent_id;
// })->first();
$parent_category =ProjectCategory::find( ProjectCategory::find($data->category_id)->parent_id);
        foreach ($data as $key => $item) {
            json_decode($item) ? $data[$key] = json_decode($item) : NULL;
            if (is_object($data[$key])) {
                foreach ($data[$key] as $sub_key => $sub_item) {
                    is_object($sub_item) ? $data[$key]->$sub_key = json_decode($sub_item) : NULL;
                }
            }
        }

        $data = (object)$data;




                return view('back-office/templates/print-pdf/businessplan',compact('data','township','categories','parent_category','owner','members','startup_needarray'));

    }
    public function BusinessplanTwo(Request $request,$id)
    {


         $townships = Township::all();
         $categories = ProjectCategory::all();
         $data = ProjectApplication::findOrFail($id);
         $members =$data->subMembers;
         $owner =$data->getAdhname;

         $startup_needs=ProjectApplication::select('financial_data',ProjectApplication::raw('count(*) as total'))->groupBy('financial_data')->where('id', $id)->get();
         $financial_data_arabic = [ 'Frais preliminaires'=>'النفقات الأولية', 'Immobilisations Incorporelle'=>"Immobilisations Incorporelle",'Terrain'=>'Terrain','Construction et / ou Aménagement'=>'الإصلاح و/أو البناء ', 'Mobilier et Matériel de bureau'=>'معدات مكتبية', 'Matériel et Outillage'=>'المعدات و الأدوات','Matériel informatique'=>'معدات معلوماتية', 'Matériel de transport'=>'معدات النقل', 'Matériel de manutention'=>'معدات المناولة',  'Fonds de roulement de démarrage'=>'Fonds de roulement de démarrage','Autre à préciser'=>'Autre à préciser'];
         $startup_needarray=[];
         $total_startupneeds=0;
         if(isset($startup_needs)){
         foreach ($startup_needs as $startup_need){
         if(isset($startup_need->financial_data->startup_needs )){
             foreach ($startup_need->financial_data->startup_needs as $startup_needd){
             $total_startupneeds+= $startup_needd->value;
         }}}}
         //dd($total_startupneeds);
         if(isset($startup_needs)){
           foreach ($startup_needs as $startup_need){
            if(isset($startup_need->financial_data->startup_needs )){
             foreach ($startup_need->financial_data->startup_needs as $startup_needd){
                 if(isset($startup_needd->labelOther)){

               $arrytwer['name']=$startup_needd->labelOther;
               $arrytwer['value']= number_format($total_startupneeds!=0?$startup_needd->value/$total_startupneeds*100:0,0, ',', ' ');
               array_push($startup_needarray, $arrytwer);

              }elseif(isset($startup_needd->label)){
              $arrytwer['name']=$startup_needd->label;
              $arrytwer['value']= number_format($total_startupneeds!=0?$startup_needd->value/$total_startupneeds*100:0,0, ',', ' ');
               array_push($startup_needarray, $arrytwer);
              }
            }
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




                return view('back-office/templates/print-pdf/businessplanTwo',compact('data','township','categories','financial_data_arabic','owner','members','startup_needarray'));

    }

    public function BusinessplanThree(Request $request,$id)
    {


         $townships = Township::all();
         $categories = ProjectCategory::all();
         $data = ProjectApplication::findOrFail($id);
         $members =$data->subMembers;
         $owner =$data->getAdhname;
         $financial_data_arabic = [ 'Frais preliminaires'=>'النفقات الأولية', 'Immobilisations Incorporelle'=>"Immobilisations Incorporelle",'Terrain'=>'Terrain','Construction et / ou Aménagement'=>'الإصلاح و/أو البناء ', 'Mobilier et Matériel de bureau'=>'معدات مكتبية', 'Matériel et Outillage'=>'المعدات و الأدوات','Matériel informatique'=>'معدات معلوماتية', 'Matériel de transport'=>'معدات النقل', 'Matériel de manutention'=>'معدات المناولة',  'Fonds de roulement de démarrage'=>'Fonds de roulement de démarrage','Autre à préciser'=>'Autre à préciser'];

         $startup_needs=ProjectApplication::select('financial_data',ProjectApplication::raw('count(*) as total'))->groupBy('financial_data')->where('id', $id)->get();
         $startup_needarray=[];
         $total_startupneeds=0;
         if(isset($startup_needs)){
         foreach ($startup_needs as $startup_need){
         if(isset($startup_need->financial_data->startup_needs )){
             foreach ($startup_need->financial_data->startup_needs as $startup_needd){
             $total_startupneeds+= $startup_needd->value;
         }}}}
         //dd($total_startupneeds);
         if(isset($startup_needs)){
           foreach ($startup_needs as $startup_need){
            if(isset($startup_need->financial_data->startup_needs )){
             foreach ($startup_need->financial_data->startup_needs as $startup_needd){
                 if(isset($startup_needd->labelOther)){

               $arrytwer['name']=$startup_needd->labelOther;
               $arrytwer['value']= number_format($total_startupneeds!=0?$startup_needd->value/$total_startupneeds*100:0,0, ',', ' ');
               array_push($startup_needarray, $arrytwer);

              }elseif(isset($startup_needd->label)){
              $arrytwer['name']=$startup_needd->label;
              $arrytwer['value']= number_format($total_startupneeds!=0?$startup_needd->value/$total_startupneeds*100:0,0, ',', ' ');
               array_push($startup_needarray, $arrytwer);
              }
            }
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


        $logo = $request->logo;


                return view('back-office/templates/print-pdf/businessplanThree',compact('data','township','categories','financial_data_arabic','owner','members','startup_needarray', 'logo'));

    }
}
