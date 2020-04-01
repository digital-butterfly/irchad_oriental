<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectSheet;
use App\Http\Resources\ProjectSheetCollection;
use Illuminate\Support\Facades\Validator;

class ProjectSheetController extends Controller
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
            'surface' => ['required', 'int'], 
            'production_value' => ['required', 'int'],  
            'turnover' => ['required', 'int'], 
            'total_jobs' => ['required', 'int'], 
            'total_investment' => ['required', 'int']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request;
        $projects = new ProjectSheetCollection(ProjectSheet::
            where(function ($q) {
                $q->where('id', 'LIKE', '%%');
            })->
            paginate(
                $perPage = 10,
                $columns = ['*'],
                $pageName = 'p',
                $page = $request->pagination['page']
            )
        );
        // return $projects;
        return view('back-office/templates/projects-sheets/all', compact('projects', 'request'));
    }
    
    /**
     * Custom function.
     *
     */
    /* public function ajaxList(Request $request)
    {
        $query = $request->get('query');
        
        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '' ;

        $role_filter = isset($query['Type']) ? $query['Type'] : '' ;;

        return new ProjectSheetCollection(ProjectSheet::
            where(function ($q) use ($search_term) {
                $q->where('id', 'LIKE', '%' .$search_term  . '%')
                    ->orWhere('title', 'LIKE', '%' . $search_term . '%');
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
    } */

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = ProjectSheet::formFields();
        // return $fields;
        return view('back-office/templates/projects-sheets/add', compact("fields"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->validator($data, 'projectSheet')->validate();

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = json_encode($value);
            }
        }

        $project = ProjectSheet::create($data);

        return redirect()->intended('admin/fiches-projets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = ProjectSheet::find($id);
        // return $project;
        return view('back-office/templates/projects-sheets/single', compact('project'));
    }

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ProjectSheet::find($id);
        $fields = ProjectSheet::formFields();
        return view('back-office/templates/projects-sheets/edit', compact('fields', 'data'));
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
        $data = $request->all();

        $this->validator($data, 'projectSheet')->validate();

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = json_encode($value);
            }
        }

        ProjectSheet::find($id)->update($data);

        return redirect()->intended('admin/fiches-projets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProjectSheet::destroy($id);
        return 'Commune supprimée !';
    }
}
