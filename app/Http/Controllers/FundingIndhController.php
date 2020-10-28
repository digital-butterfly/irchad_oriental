<?php

namespace App\Http\Controllers;

use App\FundingIndh;
use App\Http\Resources\FundingIndhCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FundingIndhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('back-office/templates/funding-indh/all');
    }

    /**
     * Add new resource.
     *
     * @return Response
     */
    public function create()
    {
        $fields = FundingIndh::formFields();
        return view('back-office/templates/funding-indh/add', compact("fields"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fundingIndh = FundingIndh::updateOrCreate([
            'status_indh'=>$request['status_indh'],
            'date_prise_charge'=>$request['date_prise_charge'],
            'id_projet'=>$request['project_id']



        ]);
//        dd($fundingIndh);
//        return redirect()->intended('admin/accountants');
    }

    /**
     * Custom function.
     *
     */
    public function ajaxListIndh(Request $request)
    {
        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '';

        $role_filter = isset($query['Type']) ? $query['Type'] : '';

        return new FundingIndhCollection(FundingIndh::join('projects_applications', 'projects_applications.id', '=', 'funding_indhs.id_projet')->selectRaw(' funding_indhs.* , projects_applications.title')->
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

//        dd(FundingIndh::findOrFail(18));
        $data =FundingIndh::findOrFail($id);
        $fields = FundingIndh::formFields();
        return view('back-office/templates/funding-indh/edit', compact('fields', 'data'));
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
            'status_indh'=>$request['status_indh'],
            'date_prise_charge'=>$request['date_prise_charge'],
                 ]);
        if($request['status_indh']==='Prêt pour envoi au CT'){
            FundingIndh::findOrfail($id)->update(['ready_cpdh'=>1]);
        }
        return redirect()->intended('admin/funding-indh');
    }
}
