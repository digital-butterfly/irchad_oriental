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

        $countNew = ProjectApplication::where('status', 'Nouveau')->count();
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
    $category->total*100/$countProjet;
    $firstArray=array('brand','danger', 'success');
    $key=rand(1,2);
    $arrywithper=ProjectCategory::select('title')->where('parent_id','!=', null )->where('id','=',$category->category_id)->get()->push($category->total*100/$countProjet)->push($firstArray[$key]);
    array_push($Sectors,$arrywithper);

}
foreach ($townships as $township){
    $arrytwer=Township::select('title')->where('id','=',$township->township_id)->get()->push($township->total*100/$countProjet);
    array_push($townshiparray, $arrytwer);
}
//todo refactor this

        return view('back-office/home', compact( 'countNew','countApprouved', 'countIncube','countRejected','countPending','countProjet','category_id','Sectors','created_date','townshiparray','townships', 'incubationdate' ));
    }

}
