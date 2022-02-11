<?php

namespace App\Http\Controllers;

use App\Incorporation;
use App\ProjectApplication;
use App\ProjectCategory;
use App\ProjectHistory;
use App\Township;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdherentController extends Controller
{
    public function index()
    {
        $user=Auth::user();
//        dd($user->status);

        $project =ProjectApplication::where('member_id',$user->id )->get();
        $township = Township::find($project[0]['township_id']);
        $project[0]['township_name'] = $township->title;
        $category = ProjectCategory::find($project[0]['category_id']);
        $project[0]['category_name'] = $category->title;
        $incorporation=Incorporation::where('id_projet',$project[0]['id'])->get();

        $project[0]['incorporationdata'] = $incorporation->toArray();
        $history=ProjectHistory::where('id_projet',$project[0]['id'])->orderBy('created_at', 'DESC')->get();
        $history->map(function($hist){
            $hist->updatedbyname =User::find ($hist->updatedBy)->only('first_name')['first_name'];
        });
        $project[0]['history'] = $history;

       $user->township_name=Township::find($user->township_id)->only('title')['title'];

        $creator = User::find($project[0]->created_by);
        $project[0]['creator'] = is_object($creator) == null ? "" : $creator->first_name . ' ' . $creator->last_name;

        $updator = User::find($project[0]->updated_by);
        $updator != NULL ? ( $project[0]['updator'] = $updator->first_name . ' ' . $updator->last_name) : NULL;
//                dd($project);
//                dd($project[0]['incorporation']);

        return view('back-office/templates/adherent/adherent', compact('user','project'));
    }
}

