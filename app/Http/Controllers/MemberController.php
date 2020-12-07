<?php

namespace App\Http\Controllers;

use App\exportCondidat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Member;
use App\Http\Resources\MemberCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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
            'birth_date'=>['required', 'date', 'max:255'],
            'identity_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'status' => ['required', 'string', 'max:255'],
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
                    ->orWhere('email', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('identity_number', 'LIKE', '%' . $search_term . '%');
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
        $otherquestions [] = array(
            "chomage" => $request["chomage"],
            "chomage_desc" => $request["chomage_desc"],
            "informal_activity_desc" => $request["informal_activity_desc"],
            "informal_activity" => $request["informal_activity"],
            "entre_activity" => $request["entre_activity"],
            "entre_activity_desc" => $request["entre_activity_desc"],
            "project_idea" => $request["project_idea"],
            "project_idea_desc" => $request["project_idea_desc"],
            "formation_needs" => $request["formation_needs"],
            "formation_needs_desc" => $request["formation_needs_desc"],


        );

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
            'otherquestions' => json_decode(json_encode($otherquestions)),

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
        if(isset($data->otherquestions)){


        $data->chomage=json_decode($data->otherquestions)[0]->chomage;
        $data->chomage_desc=json_decode($data->otherquestions)[0]->chomage_desc;
        $data->project_idea=json_decode($data->otherquestions)[0]->project_idea;
        $data->entre_activity=json_decode($data->otherquestions)[0]->entre_activity;
        $data->formation_needs=json_decode($data->otherquestions)[0]->formation_needs;
        $data->informal_activity=json_decode($data->otherquestions)[0]->informal_activity;
        $data->project_idea_desc=json_decode($data->otherquestions)[0]->project_idea_desc;
        $data->entre_activity_desc=json_decode($data->otherquestions)[0]->entre_activity_desc;
        $data->formation_needs_desc=json_decode($data->otherquestions)[0]->formation_needs_desc;
        $data->informal_activity_desc=json_decode($data->otherquestions)[0]->informal_activity_desc;
        }
//        dd($data->toArray());
//       dd ($data->otherquestions=json_decode($data->otherquestions)[0]);

//        dd($data->toArray());
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
//        dd($request->toArray());

        $otherquestions [] = array(
            "chomage" => $request["chomage"],
            "chomage_desc" => $request["chomage_desc"],
            "informal_activity_desc" => $request["informal_activity_desc"],
            "informal_activity" => $request["informal_activity"],
            "entre_activity" => $request["entre_activity"],
            "entre_activity_desc" => $request["entre_activity_desc"],
            "project_idea" => $request["project_idea"],
            "project_idea_desc" => $request["project_idea_desc"],
            "formation_needs" => $request["formation_needs"],
            "formation_needs_desc" => $request["formation_needs_desc"],


        );


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
            'state_help' => json_decode(json_encode($request['state_help'])),
            'reduced_mobility' => $request['reduced_mobility'],
            'otherquestions' => json_decode(json_encode($otherquestions)),
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
        try{
            $member->delete();

            return response()->json(['message'=>'Utilisateur supprimé !'],200);

        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['message'=>'Utilisateur non supprimer veuillez supprimer les entites liées a la Utilisateur'],409);
        }
    }




    public function exportExcel(Request $request)
    {
//        dd($request->toArray());

//        $projectApplicatoin=   Member::all()->where('status',$request['status']);
//        $arrays = new exportCondidat((array) json_decode(ProjectApplication::all()->where('status', $request['Status'])));
//        dd($request['Status']);
        return Excel::download(new exportCondidat($request['Status'],$request['Type']), Carbon::now().'-back-up.xlsx');

    }
}
