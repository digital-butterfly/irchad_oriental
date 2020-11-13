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
        $data =FundingIndh::findOrFail($id);
        $fields = Fundingcpdh::formFields();
//        dd($data);
        return view('back-office/templates/funding-cpdh/edit', compact('fields', 'data'));
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


        $fundingext= FundingExterne::where("id_projet",$request['project_id'])->get();

        $fundingext[0]->update([
            'status_ext'=>$request['status_ext'],
            'observation_ext'=>$request['observation_ext'],
            'montant'=>$request['montant'],
            'funding_organism'=>$request['funding_organism'],
        ]);
//        if($request['status_cpdh']==='Accepté'){
//            FundingIndh::findOrfail($id)->update(['ready_cpdh'=>1]);
//        }
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
