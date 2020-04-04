<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectApplication;
use App\Member;
use App\ProjectCategory;
use App\Township;
use App\Http\Resources\ProjectApplicationCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProjectApplicationController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param  string  $type
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $type)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:applications'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$applications = ProjectApplication::all();
        return view('back-office/templates/projects-applications/all');
    }
    
    /**
     * Custom function.
     *
     */
    public function ajaxList(Request $request)
    {
        $query = $request->get('query');
        
        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '' ;

        $role_filter = isset($query['Type']) ? $query['Type'] : '' ;;

        return new ProjectApplicationCollection(ProjectApplication::
            where(function ($q) use ($search_term) {
                $q->where('id', 'LIKE', '%' .$search_term  . '%')
                    ->orWhere('title', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('description', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('member_id', 'LIKE', '%' . $search_term . '%');
            })->
            where(function ($q) use ($role_filter) {
                $role_filter ? $q->whereRaw('LOWER(status) = ?', [$role_filter]) : NULL;
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

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = ProjectApplication::formFields();
        return view('back-office/templates/projects-applications/add', compact("fields"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $application = ProjectApplication::create([
            'member_id' => $request['member_id'], 
            'category_id' => $request['category_id'], 
            'township_id' => $request['township_id'], 
            'sheet_id' => $request['sheet_id'], 
            'title' => $request['title'], 
            'description' => $request['description'], 
            'business_model' => json_decode(json_encode([
                'core_business' => $request['core_business'],
                'key_ressources' => $request['key_ressources'],
                'primary_target' => $request['primary_target'],
                'cost_structure' => $request['cost_structure'],
                'income' => $request['income'],
            ])), 
            'financial_data' => json_decode(json_encode([
                'financial_plan' => $request['financial_plan'],
                'startup_needs' => $request['startup_needs'],
                'overheads' => $request['overheads'],
                'human_ressources' => $request['human_ressources'],
                'services_turnover_forecast' => $request['services_turnover_forecast'],
                'products_turnover_forecast' => $request['products_turnover_forecast'],
                'profit_margin_rate' => $request['profit_margin_rate'],
                'evolution_rate' => $request['evolution_rate'],
            ])), 
            'company' => json_decode(json_encode([
                'legal_form' => $request['legal_form'],
                'is_created' => $request['is_created'],
                'creation_date' => $request['creation_date'],
                'corporate_name' => $request['corporate_name'],
            ])),
            'status' => $request['status']
        ]);
        return redirect()->intended('admin/candidatures');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = ProjectApplication::find($id);

        $member = Member::find($application->member_id);

        $category = ProjectCategory::find($application->category_id);

        $township = Township::find($application->township_id);

        $application->member = $member;

        $application->category_title = $category->title;

        $application->township_name = $township->title;

        $data = ProjectApplication::find($id);

        foreach ($data as $key => $item){
            json_decode($item) ? $data[$key] = json_decode($item) : NULL;
            if (is_object($data[$key])) {
                foreach ($data[$key] as $sub_key => $sub_item) {
                    is_object($sub_item) ? $data[$key]->$sub_key = json_decode($sub_item) : NULL;
                }
            } 
        }

        $data = (object)$data;

        $fields = ProjectApplication::formFields();

        return view('back-office/templates/projects-applications/single', compact('application', 'data', 'fields'));
    }

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ProjectApplication::find($id);
        $fields = ProjectApplication::formFields();
        return view('back-office/templates/projects-applications/edit', compact('fields', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectApplication $application)
    {
        $application->update([
            'first_name' => strtolower($request['first_name']),
            'last_name' => strtolower($request['last_name']),
            'email' => $request['email'],
            'identity_number' => $request['identity_number'],
            'phone' => $request['phone'],
            'birth_date' => $request['birth_date'],
            'address' => $request['address'],
            'township_id' => $request['township_id'],
        ]);

        if ($request['role']) {
            $application->update([
                'role' => $request['role'],
            ]);
        }

        return redirect()->intended('admin/candidatures');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectApplication $application)
    {
        $application->delete();
        return 'Utilisateur supprimé !';
    }
}
