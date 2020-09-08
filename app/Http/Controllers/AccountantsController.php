<?php

namespace App\Http\Controllers;

use App\Accountants;
use App\Http\Resources\accountantsCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office/templates/accountants/all');
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

        return new AccountantsCollection(Accountants::
        where(function ($q) use ($search_term) {
            $q->where('id', 'LIKE', '%' .$search_term  . '%')
                ->orWhere('first_name', 'LIKE', '%' . $search_term . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search_term . '%')
                ->orWhere('e-mail', 'LIKE', '%' . $search_term . '%')
                ->orWhere('tel', 'LIKE', '%' . $search_term . '%');
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
        $fields = Accountants::formFields();
        return view('back-office/templates/accountants/add', compact("fields"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all(), 'township')->validate();
        $accountants = Accountants::create([
            'first_name'=> $request['first_name'],
            'last_name'=> $request['last_name'],
            'gender'=> $request['gender'],
            'tel'=> $request['tel'],
            'e-mail'=> $request['email'],
            'address'=> $request['address']

        ]);
        return redirect()->intended('admin/accountants');
    }
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
            'gender' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);
    }
    /**
     * edit resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Accountants::find($id);
        $fields = Accountants::formFields();
        return view('back-office/templates/accountants/edit', compact('fields', 'data'));
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
        Accountants::find($id)->update([
            'first_name'=> $request['first_name'],
            'last_name'=> $request['last_name'],
            'gender'=> $request['gender'],
            'tel'=> $request['tel'],
            'e-mail'=> $request['e-mail'],
            'address'=> $request['address']
        ]);

        return redirect()->intended('admin/accountants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            Accountants::destroy($id);
            return response()->json(['message'=>'Comptables supprimé !'],200);

        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['message'=>'Comptables non supprimer veuillez supprimer les entites liées a cette commune'],409);
        }
    }
}
