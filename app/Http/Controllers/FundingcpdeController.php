<?php

namespace App\Http\Controllers;

use App\Fundingcpde;
use App\FundingIndh;
use App\Http\Resources\FundingCpdeCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FundingcpdeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('back-office/templates/funding-cpde/all');
    }
    public function ajaxListCpde(Request $request)
    {
        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '';

        $role_filter = isset($query['Type']) ? $query['Type'] : '';

        return new FundingCpdeCollection(FundingIndh::join('projects_applications', 'projects_applications.id', '=', 'funding_indhs.id_projet')->selectRaw(' funding_indhs.* , projects_applications.title')->
        where('sent_cpde',1)->
        where('sent_cpdh',0)->
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
        $fields = Fundingcpde::formFields();
//        dd($data);
        return view('back-office/templates/funding-cpde/edit', compact('fields', 'data'));
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
            'status_cpde'=>$request['status_cpde'],
            'observation_cpde'=>$request['observation_cpde'],
        ]);
        if($request['status_cpde']==='Accepté'){
            FundingIndh::findOrfail($id)->update(['ready_cpdh'=>1]);
        }
        return redirect()->intended('admin/funding-cpde');
    }


    /**
     * Custom function to get pools of n
     *
     */
    public function pool(Request $request){
        $collection = FundingIndh::join('projects_applications', 'projects_applications.id', '=', 'funding_indhs.id_projet')->selectRaw('funding_indhs.* , projects_applications.title')
            ->where('status_cpde','Accepté')->where('ready_cpdh','1')->where('sent_cpdh','0')->get();
        $groups = $collection->chunk(5);
        foreach ($groups as $key => $chunk) {
            $groups[$key] = array_values($chunk->toArray());
        }
        return $groups;
    }
    /**
     * Update the pool of specified resources in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param FundingIndh $fundingindh
     * @return \Illuminate\Http\Response
     */
    public function updatepool(Request $request )
    {
        foreach ($request->toArray() as $item){

            FundingIndh::findOrfail($item['id'])->update([
                'status_cpdh'=>'en cours',
                'sent_cpdh'=>1,
            ]);
        }

    }
}
