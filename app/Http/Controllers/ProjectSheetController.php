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
            'title' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('back-office/templates/projects-sheets/all');
        return '<a href="fiches-projets/create">Ajouter</a>' ;
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
    }

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
        $this->validator($request->all(), 'project')->validate();
        $project = ProjectSheet::create([
            'title' => $request['title'],
        ]);
        return redirect()->intended('admin/communes');
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
        return $project;
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
        return view('back-office/templates/projects/edit', compact('fields', 'data'));
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
        ProjectSheet::find($id)->update([
            'title' => $request['title'],
        ]);

        return redirect()->intended('admin/communes');
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
