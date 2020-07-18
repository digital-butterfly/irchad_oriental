<?php


namespace App\Http\Controllers;



use App\ProjectApplication;
use App\ProjectCategory;
use Illuminate\Http\Request;
use App\Township;



class DashboardController
{

    public function ajaxList(Request $request)
    {

        $New = ProjectApplication::select('created_at',ProjectApplication::raw('count(*) as total'))->where('status', 'Nouveau')->groupBy('created_at')->get();
        $countNew=ProjectApplication::where('status', 'Nouveau')->count();
//        dd($New->toArray());
        $countApprouved = ProjectApplication::where('status', 'Accepté')->count();
        $countIncube = ProjectApplication::where('status', 'Incubé')->count();
        $countRejected = ProjectApplication::where('status', 'Rejeté')->count();
        $countPending = ProjectApplication::where('status','!=', 'Rejeté')->where('status','!=', 'Incubé') ->count();
        $countProjet =  ProjectApplication::count();
        $category_id=ProjectApplication::select('category_id',ProjectApplication::raw('count(*) as total'))->groupBy('category_id')->get();
        $townships=ProjectApplication::select('township_id',ProjectApplication::raw('count(*) as total'))->groupBy('township_id')->get();
        $Sectors=[];
        $townshiparray=[];
        $created_date=ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, ' %m-%e-%Y') date")->
        where('status','!=', 'Rejeté')->where('status','!=', 'Incubé')
            ->groupBy('date')->take(7)
            ->get();
        $incubationdate=ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, ' %m-%e-%Y') date")->
        where('status', 'Incubé')
            ->groupBy('date')->take(7)
            ->get();
foreach ($category_id as $category){
//    dd($category->toArray());
    $firstArray=array('brand', 'success','blue','green','orange');;
    $key=rand(0,4);
//    $key=shuffle($key);
//    dd($key);
    $arrywithper=ProjectCategory::where('id', $category->category_id)->firstOrFail()->getParent->toArray();
//    array_push($arrywithper,);
    $arrywithper['total']= ($category->total*100/$countProjet);
    $arrywithper['Type']= ($firstArray[$key]);

//    dd($arrywithper);
    array_push($Sectors,$arrywithper);

}
//        dd($Sectors);
foreach ($townships as $township){
    $firstArray=array('brand', 'success','blue','green','orange');;
    $key=rand(0,4);
    $arrytwer=Township::select('title')->where('id','=',$township->township_id)->firstOrFail()->toArray();
    $arrytwer['total']=($township->total*100/$countProjet);
    $arrytwer['Type']= ($firstArray[$key]);
    array_push($townshiparray, $arrytwer);


//    dd($townshiparray);
}
//todo refactor this

        return view('back-office/home', compact( 'countNew','New','countApprouved', 'countIncube','countRejected','countPending','countProjet','category_id','Sectors','created_date','townshiparray','townships', 'incubationdate' ));
    }

}
