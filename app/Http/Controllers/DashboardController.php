<?php


namespace App\Http\Controllers;



use App\ProjectApplication;
use App\ProjectCategory;
use Illuminate\Http\Request;

class DashboardController
{
    public function ajaxList(Request $request)
    {
//        $application = ProjectApplication::all();
        $countNew = ProjectApplication::where('status', 'Nouveau')->count();
        $countApprouved = ProjectApplication::where('status', 'Accepté')->count();
        $countIncube = ProjectApplication::where('status', 'Incubé')->count();
        $countRejected = ProjectApplication::where('status', 'Rejeté')->count();
        $countPending = ProjectApplication::where('status','!=', 'Rejeté')->where('status','!=', 'Incubé') ->count();
        $countProjet =  ProjectApplication::count();
//        $secteurs =ProjectCategory:: where('parent_id','!=','null');
//        $countP =  ProjectApplication::where('category_id',$secteurs);



        return view('back-office/home', compact( 'countNew','countApprouved', 'countIncube','countRejected','countPending','countProjet'));
    }

}
