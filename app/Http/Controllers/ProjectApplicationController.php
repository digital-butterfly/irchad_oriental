<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectApplication;
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
            'password' => ['required', 'string', 'min:4', 'confirmed'],
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
                $request->sort['field'] != 'name' ? $request->sort['field'] : 'first_name',
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
        $this->validator($request->all(), 'application')->validate();
        $application = ProjectApplication::create([
            'first_name' => strtolower($request['first_name']),
            'last_name' => strtolower($request['last_name']),
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'identity_number' => $request['identity_number'],
            'phone' => $request['phone'],
            'status' => $request['status'],
            'gender' => $request['gender'],
            'birth_date' => $request['birth_date']->format('Y-m-d'),
            'address' => $request['address'],
            'township_id' => $request['township_id'],
            'degrees' => json_encode($request['degrees']),
            'professional_experience' => json_encode($request['professional_experience']),
            'reduced_mobility' => $request['reduced_mobility'],
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
        return $application;
    }

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectApplication $application)
    {
        $data = $application;
        $fields = ProjectApplication::formFields();
        return view('back-office/templates/candidatures/edit', compact('fields', 'data'));
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

        if ($request['password']) {
            $application->update([
                'password' => Hash::make($request['password']),
            ]);
        }

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
