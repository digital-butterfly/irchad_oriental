<?php

namespace App\Http\Controllers;

use App\FundingExterne;
use App\FundingIndh;
use App\Http\Resources\FundingExtCollection;
use Illuminate\Http\Request;

class FundingExterneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('back-office/templates/funding-extern/all');
    }
    public function ajaxListext(Request $request)
    {
        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '';

        $role_filter = isset($query['Type']) ? $query['Type'] : '';

        return new FundingExtCollection(FundingExterne::join('projects_applications', 'projects_applications.id', '=', 'funding_externes.id_projet')->selectRaw(' funding_externes.* , projects_applications.title')->
        where(function ($q) use ($search_term) {
//            $q->where('id', 'LIKE', '%' .$search_term  . '%')
//                ->orWhere('first_name', 'LIKE', '%' . $search_term . '%')
//                ->orWhere('last_name', 'LIKE', '%' . $search_term . '%')
//                ->orWhere('e-mail', 'LIKE', '%' . $search_term . '%')
//                ->orWhere('tel', 'LIKE', '%' . $search_term . '%');
        })->
        orderBy(
            $request->sort['field'],
            $request->sort['sort']
        )->
        paginate(
            $perPage = (int)$request->pagination['perpage'],
            $columns = ['*'],
            $pageName = '*',
            $page = $request->pagination['page']
        )
        );
    }
    public function edit($id)
    {
        $data =FundingExterne::findOrFail($id);
        $fields = FundingExterne::formFields();
//        dd($id);
//        dd($data);
        return view('back-office/templates/funding-extern/edit', compact('fields', 'data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param FundingIndh $fundingindh
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        if ($request['project_id']){
            $fundingext= FundingExterne::where("id_projet",$request['project_id'])->get();

            $funding= $fundingext[0];
            $funding->update([
                'status_ext'=>$request['status_ext'],
                'observation_ext'=>$request['observation_ext'],
                'montant'=>$request['montant'],
                'funding_organism'=>$request['funding_organism'],
            ]);
            if($request['status_ext']==='Accepté'){
                ProjectApplication::findOrFail($funding->id_projet)->update(['funding'=>'Financé']);
            }
            elseif($request['status_ext']==='Refusé'){
                ProjectApplication::findOrFail($funding->id_projet)->update(['funding'=>'Financement refusé']);
            }

        }
        else{
            $fundingext= FundingExterne::findOrFail($id);

            $funding=$fundingext;
            $funding->update([
                'status_ext'=>$request['status_ext'],
                'observation_ext'=>$request['observation_ext'],
                'montant'=>$request['montant'],
                'funding_organism'=>$request['funding_organism'],
            ]);
            if($request['status_ext']==='Accepté'){
                ProjectApplication::findOrFail($funding->id_projet)->update(['funding'=>'Financé']);
            }
            elseif($request['status_ext']==='Refusé'){
                ProjectApplication::findOrFail($funding->id_projet)->update(['funding'=>'Financement refusé']);
            }
//        if($request['status_cpdh']==='Accepté'){
//            FundingIndh::findOrfail($id)->update(['ready_cpdh'=>1]);
//        }
        }

        return redirect()->intended('admin/funding-ext');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fundingIndh = FundingExterne::updateOrCreate([
            'funding_organism'=>$request['funding_organism'],
            'date_prise_charge_ext'=>$request['date_prise_charge_ext'],
            'status_ext'=>$request['status_ext'],
            'observation_ext'=>$request['observation_ext'],
            'id_projet'=>$request['project_id'],
            'montant'=>$request['montant'],
        ]);

//        dd($fundingIndh);
        return redirect()->intended('admin/funding-indh');
    }
}
