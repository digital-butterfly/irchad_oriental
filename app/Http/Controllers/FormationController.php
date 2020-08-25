<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\FormationCollection;
use App\Formation;

class FormationController extends Controller
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
            'description' => ['required', 'string', 'max:255'],
            'domaine' => ['required', 'string', 'max:255'],

        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office/templates/formation/all');
    }

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = Formation::formFields();
        return view('back-office/templates/formation/add', compact("fields"));
    }
    public function store(Request $request)
    {
        $this->validator($request->all(), 'formation')->validate();
        Formation::create([
            'title' => $request['title'],
            'description' =>$request['description'],
            'domaine' => $request['domaine'],

        ]);
        return redirect()->intended('admin/formation');
    }

    public function ajaxList(Request $request)
    {

        $query = $request->get('query');
        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '' ;

        $role_filter = isset($query['Type']) ? $query['Type'] : '' ;;

        return new FormationCollection(Formation::
        where(function ($q) use ($search_term) {
            $q->where('id', 'LIKE', '%' .$search_term  . '%')
                ->orWhere('id', 'LIKE', '%' . $search_term . '%')
                ->orWhere('title', 'LIKE', '%' . $search_term . '%');
        })->
        where(function ($q) use ($role_filter) {
            $role_filter ? $q->whereRaw('LOWER(status) = ?', [$role_filter]) : NULL;
        })->
        orderBy(
            $request->sort['field'] != 'name' ? $request->sort['field'] : 'title',
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

    public function edit(Formation $formation)
    {
        $data = $formation;
        $fields = Formation::formFields();
        return view('back-office/templates/Formation/edit', compact('fields', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Formation $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation )
    {
        $formation->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'domaine' => $request['domaine'],

        ]);
        return redirect()->intended('admin/formation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Formation $formation
     * @return string
     * @throws \Exception
     */
    public function destroy(Formation $formation)
    {
        try{
            $formation->delete();

            return response()->json(['message'=>'Utilisateur supprimé !'],200);

        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['message'=>'Formation non supprimer veuillez supprimer les entites liées a la Formation'],409);
        }
    }

}
