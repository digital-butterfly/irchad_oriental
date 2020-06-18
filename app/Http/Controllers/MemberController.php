<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Http\Resources\MemberCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            'phone' => ['required', 'string', 'max:255'],
            'identity_number' => ['required', 'string', 'max:255'],
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
        //$members = Member::all();
        return view('back-office/templates/members/all');
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

        return new MemberCollection(Member::
            where(function ($q) use ($search_term) {
                $q->where('id', 'LIKE', '%' .$search_term  . '%')
                    ->orWhere('id', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('first_name', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('email', 'LIKE', '%' . $search_term . '%');
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
        $fields = Member::formFields();
        return view('back-office/templates/members/add', compact("fields"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all(), 'member')->validate();
        $member = Member::create([
            'first_name' => strtolower($request['first_name']),
            'last_name' => strtolower($request['last_name']),
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'identity_number' => $request['identity_number'],
            'phone' => $request['phone'],
            'status' => $request['status'],
            'gender' => $request['gender'],
            'birth_date' => $request['birth_date'],
            'address' => $request['address'],
            'township_id' => $request['township_id'],
            'degrees' => json_decode(json_encode($request['degrees'])),
            'professional_experience' => json_decode(json_encode($request['professional_experience'])),
            'reduced_mobility' => $request['reduced_mobility'],
        ]);
        return redirect()->intended('admin/members');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return $member;
    }

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $data = $member;
        $fields = Member::formFields();
        return view('back-office/templates/members/edit', compact('fields', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $member->update([
            'first_name' => strtolower($request['first_name']),
            'last_name' => strtolower($request['last_name']),
            'email' => $request['email'],
            'identity_number' => $request['identity_number'],
            'phone' => $request['phone'],
            'birth_date' => $request['birth_date'],
            'address' => $request['address'],
            'township_id' => $request['township_id'],
            'degrees' => json_decode(json_encode($request['degrees'])),
            'professional_experience' => json_decode(json_encode($request['professional_experience'])),
            'reduced_mobility' => $request['reduced_mobility'],
        ]);

        if ($request['password']) {
            $member->update([
                'password' => Hash::make($request['password']),
            ]);
        }

        if ($request['status']) {
            $member->update([
                'status' => $request['status'],
            ]);
        }

        return redirect()->intended('admin/members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Member $member
     * @return string
     * @throws \Exception
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return 'Utilisateur supprimé !';
    }
}
