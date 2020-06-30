<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ProjectApplication;
use App\User;
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
            'legal_form' => ['nullable', 'string', 'max:155'],
            'capital' => ['nullable', 'integer'],
            'corporate_name' => ['nullable', 'string', 'max:155'],
            'member_id' => ['required', 'integer', 'exists:members,id'],
            'category_id' => ['nullable', 'integer', 'exists:projects_categories,id'],
            'township_id' => ['required', 'integer', 'exists:townships,id'],
            'title' => ['required', 'string', 'max:155'],
            'description' => ['nullable', 'string', 'max:455'],
            'market_type' => ['nullable', 'string', 'max:155'],
            'core_business' => ['nullable', 'string', 'max:455'],
            'primary_target' => ['nullable', 'string', 'max:455'],
            'suppliers' => ['nullable', 'string', 'max:455'],
            'competition' => ['nullable', 'string', 'max:455'],
            'advertising' => ['nullable', 'string', 'max:455'],
            'pricing_strategy' => ['nullable', 'string', 'max:455'],
            'distribution_strategy' => ['nullable', 'string', 'max:455'],
            'startup_needs.*.value' => ['nullable', 'integer'],
            'startup_needs.*.rate' => ['nullable', 'integer'],
            'startup_needs.*.duration' => ['nullable', 'integer'],
            'financial_plan.*.value' => ['nullable', 'integer'],
            'financial_plan_loans.*.value' => ['nullable', 'integer'],
            'financial_plan_loans.*.rate' => ['nullable', 'integer'],
            'financial_plan_loans.*.duration' => ['nullable', 'integer'],
            'services_turnover_forecast' => ['nullable', 'integer'],
            'products_turnover_forecast' => ['nullable', 'integer'],
            'profit_margin_rate' => ['nullable', 'integer'],
            'evolution_rate' => ['nullable', 'integer'],
            'overheads_fixed.*.value' => ['nullable', 'integer'],
            'overheads_scalable.*.value' => ['nullable', 'integer'],
            'human_ressources.*.count' => ['nullable', 'integer'],
            'human_ressources.*.value' => ['nullable', 'integer'],
            'taxes.*.value' => ['nullable', 'integer'],
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
        $training_filter = isset($query['Formation']) ? $query['Formation'] : '' ;;
        $incorporation_filter = isset($query['Création']) ? $query['Création'] : '' ;;
        $funding_filter = isset($query['Financement']) ? $query['Financement'] : '' ;;
        $progress_filter = isset($query['progress']) ? $query['progress'] : '' ;;

        return new ProjectApplicationCollection(ProjectApplication::
            where(function ($q) use ($search_term) {
                $q->where('id', 'LIKE', '%' .$search_term  . '%')
                    ->orWhere('title', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('description', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('member_id', 'LIKE', '%' . $search_term . '%');
            })->
            where(function ($q) use ($role_filter) {
                $role_filter ? $q->whereRaw('LOWER(status) = ?' , [$role_filter]) : NULL;

            })->where(function ($q) use ($progress_filter) {
            $progress_filter ? $q->whereRaw('LOWER(progress) = ?', [$progress_filter]) : NULL;

            })->where(function ($q) use ($training_filter) {
                $training_filter ? $q->whereRaw('LOWER(training) = ?', [$training_filter]) : NULL;
            })->where(function ($q) use ($funding_filter) {
                $funding_filter ? $q->whereRaw('LOWER(funding) = ?', [$funding_filter]) : NULL;
            })->where(function ($q) use ($incorporation_filter) {
                $incorporation_filter ? $q->whereRaw('LOWER(incorporation) = ?', [$incorporation_filter]) : NULL;
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
        $validation = $this->validator($request->all(), 'projectApplication');
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $application = ProjectApplication::create([
            'member_id' => $request['member_id'],
            'category_id' => $request['category_id'],
            'township_id' => $request['township_id'],
            'sheet_id' => $request['sheet_id'],
            'title' => $request['title'],
            'description' => $request['description'],
            'market_type' => $request['market_type'],
            'business_model' => json_decode(json_encode([
                'core_business' => $request['core_business'],
                'primary_target' => $request['primary_target'],
                'suppliers' => $request['suppliers'],
                'competition' => $request['competition'],
                'advertising' => $request['advertising'],
                'pricing_strategy' => $request['pricing_strategy'],
                'distribution_strategy' => $request['distribution_strategy'],
            ])),
            'financial_data' => json_decode(json_encode([
                'financial_plan' => $request['financial_plan'],
                'financial_plan_loans' => $request['financial_plan_loans'],
                'startup_needs' => $request['startup_needs'],
                'overheads_fixed' => $request['overheads_fixed'],
                'overheads_scalable' => $request['overheads_scalable'],
                'human_ressources' => $request['human_ressources'],
                'taxes' => $request['taxes'],
                'services_turnover_forecast' => $request['services_turnover_forecast'],
                'products_turnover_forecast' => $request['products_turnover_forecast'],
                'profit_margin_rate' => $request['profit_margin_rate'],
                'evolution_rate' => $request['evolution_rate'],
            ])),
            'company' => json_decode(json_encode([
                'legal_form' => $request['legal_form'],
                'is_created' => $request['is_created'],
                'capital' => $request['capital'],
                'creation_date' => $request['creation_date'],
                'corporate_name' => $request['corporate_name'],
                'applied_tax' => $request['applied_tax'],
            ])),
            'training_needs' => json_decode(json_encode([
                'pre_creation_training' => $request['pre_creation_training'],
                'post_creation_training' => $request['post_creation_training'],
            ])),
            'status' => $request['status'],
            'progress' => $request['progress'],
            'training' => $request['training'],
            'incorporation' => $request['incorporation'],
            'funding' => $request['funding'],
            'created_by' => Auth::id()
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

        $creator = User::find($application->created_by);

        $updator = User::find($application->updated_by);

        $application->member = $member;

        $application->category_title = is_object($category) == null ? "" : $category->title;

        $application->township_name = $township->title;

        $application->creator = is_object($creator) == null ? "" : $creator->first_name . ' ' . $creator->last_name;

        $updator != NULL ? ($application->updator = $updator->first_name . ' ' . $updator->last_name) : NULL;



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
    public function update(Request $request, $id)
    {
//        dd($id);
        $validation = $this->validator($request->all(), 'projectApplication');
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        ProjectApplication::find($id)->update([
            'member_id' => $request['member_id'],
            'category_id' => $request['category_id'],
            'township_id' => $request['township_id'],
            'sheet_id' => $request['sheet_id'],
            'title' => $request['title'],
            'description' => $request['description'],
            'market_type' => $request['market_type'],
            'business_model' => json_decode(json_encode([
                'core_business' => $request['core_business'],
                'primary_target' => $request['primary_target'],
                'suppliers' => $request['suppliers'],
                'competition' => $request['competition'],
                'advertising' => $request['advertising'],
                'pricing_strategy' => $request['pricing_strategy'],
                'distribution_strategy' => $request['distribution_strategy'],
            ])),
            'financial_data' => json_decode(json_encode([
                'financial_plan' => $request['financial_plan'],
                'financial_plan_loans' => $request['financial_plan_loans'],
                'startup_needs' => $request['startup_needs'],
                'overheads_fixed' => $request['overheads_fixed'],
                'overheads_scalable' => $request['overheads_scalable'],
                'human_ressources' => $request['human_ressources'],
                'taxes' => $request['taxes'],
                'services_turnover_forecast' => $request['services_turnover_forecast'],
                'products_turnover_forecast' => $request['products_turnover_forecast'],
                'profit_margin_rate' => $request['profit_margin_rate'],
                'evolution_rate' => $request['evolution_rate'],
            ])),
            'company' => [
                'legal_form' => $request['legal_form'],
                'is_created' => $request['is_created'],
                'capital' => $request['capital'],
                'creation_date' => $request['creation_date'],
                'corporate_name' => $request['corporate_name'],
                'applied_tax' => $request['applied_tax'],
            ],
            'training_needs' => json_decode(json_encode([
                'pre_creation_training' => $request['pre_creation_training'],
                'post_creation_training' => $request['post_creation_training'],
            ])),
            'status' => $request['status'],
             'progress' => $request['progress'],
            'training' => $request['training'],
            'incorporation' => $request['incorporation'],
            'funding' => $request['funding'],
            'created_by' => Auth::id()
        ]);

        return redirect()->intended('admin/candidatures/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProjectApplication $application
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id)
    {

        $result=ProjectApplication::destroy($id);
        if ($result)
        {
            return response()->json(['message'=>'Project application supprimé !'],200);
        }
        return response()->json(['message'=>'Project application na pas etait supprimer!'],404);
    }
}
