<?php


namespace App\Http\Controllers;



use App\ProjectApplication;
use App\ProjectCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Township;



class DashboardController
{

    public function ajaxList(Request $request)
    {

        $New = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%m-%e-%Y') date")->where('status', 'Nouveau')->groupBy('date')->get();
        $NewMonth = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%M') date")->where('status', 'Nouveau')->groupBy('date')->get();
        $byweek = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%U-%X') week")->where('status', 'Nouveau')->groupBy('week')->get();

        $Rejected = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%m-%e-%Y') date")->where('status', 'Rejeté')->groupBy('date')->get();
        $RejectedMonth = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%M') date")->where('status', 'Rejeté')->groupBy('date')->get();
        $byweekRejected = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%U-%X') week")->where('status', 'Rejeté')->groupBy('week')->get();

        $Incube = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%m-%e-%Y') date")->where('status', 'Incubé')->groupBy('date')->get();
        $IncubeMonth = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%M') date")->where('status', 'Incubé')->groupBy('date')->get();
        $byweekIncube = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%U-%X') week")->where('status', 'Incubé')->groupBy('week')->get();

        $Accepted = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%m-%e-%Y') date")->where('status', 'Accepté')->groupBy('date')->get();
        $AcceptedMonth = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%M') date")->where('status', 'Accepté')->groupBy('date')->get();
        $byweekAccepted = ProjectApplication::selectRaw("COUNT(*) datecount, DATE_FORMAT(created_at, '%U-%X') week")->where('status', 'Accepté')->groupBy('week')->get();

//dd($byweek->toArray());
        $countNew=ProjectApplication::where('status', 'Nouveau')->count();
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
        $arrywithper=collect();
    foreach ($category_id as $category){
    $firstArray=array('brand', 'success','blue','green','orange');
//  $key=shuffle($key);
//  dd($key);
$obj=ProjectCategory::where('id', $category->category_id)->firstOrFail()->getParent;
$obj['total']=($category->total*100/$countProjet);
    $arrywithper->push($obj);
$raw = sizeof($arrywithper);
        for ($i=0; $i<$raw-1;$i++){
            if ($i===$raw-1){
                $i=0;
            }
//            dump($firstArray[$i]);
            $obj['Type']= ($firstArray[$i]);

        }



}
        $Sectors=$arrywithper->groupBy('title')->toArray();
//dd($Sectors);
foreach ($townships as $township){
    $firstArray=array('brand', 'success','blue','green','orange');;
    $key=rand(0,4);
    $arrytwer=Township::select('title')->where('id','=',$township->township_id)->firstOrFail()->toArray();
    $arrytwer['total']=($township->total*100/$countProjet);
    $arrytwer['Type']= ($firstArray[$key]);
    array_push($townshiparray, $arrytwer);

}
//todo refactor this

        return view('back-office/home', compact( 'Accepted','AcceptedMonth','byweekAccepted','Incube','IncubeMonth','byweekIncube','Rejected','RejectedMonth','byweekRejected','countNew','New','byweek','NewMonth','countApprouved', 'countIncube','countRejected','countPending','countProjet','category_id','Sectors','created_date','townshiparray','townships', 'incubationdate' ));
    }

}
