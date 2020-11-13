<?php

namespace App\Http\Controllers;

use App\Fundingcpdh;
use App\FundingIndh;
use App\Http\Resources\FundingCpdhCollection;
use Illuminate\Http\Request;

class FundingcpdhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('back-office/templates/funding-cpdh/all');
    }
    public function ajaxListCpdh(Request $request)
    {
        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '';

        $role_filter = isset($query['Type']) ? $query['Type'] : '';

        return new FundingCpdhCollection(FundingIndh::join('projects_applications', 'projects_applications.id', '=', 'funding_indhs.id_projet')->selectRaw(' funding_indhs.* , projects_applications.title')->
        where('sent_cpde',1)->
        where('sent_cpdh',1)->
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

        FundingIndh::findOrfail($id)->update([
            'status_cpdh'=>$request['status_cpdh'],
            'observation_cpdh'=>$request['observation_cpdh'],
            'montant'=>$request['montant'],
        ]);
//        if($request['status_cpdh']==='Accepté'){
//            FundingIndh::findOrfail($id)->update(['ready_cpdh'=>1]);
//        }
        return redirect()->intended('admin/funding-cpdh');
    }


}
