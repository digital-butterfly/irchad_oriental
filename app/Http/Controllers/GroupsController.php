<?php

namespace App\Http\Controllers;

use App\AdherentSession;
use App\Formation;
use App\groups;
use App\groupSessionMembers;
use App\Http\Resources\SessionCollection;
use App\Member;
use App\ProjectApplication;
use App\ProjectApplicationMember;
use App\ProjectHistory;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupsController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param  string  $type
     * @return Validator
     */
    protected function validator(array $data, $type)
    {
        return Validator::make($data, [


        ]);
    }
    public function show()
    {
        $value=null;
        $fields = Session::formFields($value);
        return view('back-office/templates/groups/all-calendar', compact("fields"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office/templates/groups/all');
    }

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $value=null;
        $fields = groups::formFields($value);
        return view('back-office/templates/groups/add', compact("fields"));
    }
    public function store(Request $request)
    {



            $this->validator($request->all(), 'groups')->validate();
            $groups=groups::create([
                'title'=> $request['title'],
                ]);

            if (json_decode($request['members'])) {
//            dd($request->toArray());
                foreach (json_decode($request['members']) as $key =>$value)
                {                     groupSessionMembers::updateOrCreate([
                            'group_id'=> $groups['id'],
                            'id_projet' => $value->project_id,
                            'id_member' => $value->member_id,

                        ]
                    );
                }
        }
        return redirect()->intended('admin/groups');
    }

    public function ajaxList(Request $request)
    {
//        dd($request->toArray());

        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '' ;

        $role_filter = isset($query['Type']) ? $query['Type'] : '' ;;
        $sessions=new SessionCollection(groups::
        where(function ($q) use ($search_term) {
            $q->where('title', 'LIKE', '%' .$search_term  . '%')
                ->orWhere('id', 'LIKE', '%' . $search_term . '%');

        })->
        where(function ($q) use ($role_filter) {
            $role_filter ? $q->whereRaw('LOWER(status) = ?', [$role_filter]) : NULL;
        })->
        orderBy(
            $request->sort['field'] != 'name' ? $request->sort['field'] : 'member_id',
            $request->sort['sort']
        )->
        paginate(
            $perPage = (int)$request->pagination['perpage'],
            $columns = ['*'],
            $pageName = '*',
            $page = $request->pagination['page']
        )
        );
//dd($sessions);
        return  $sessions;
    }

    public function edit(groups $group)
    {
        $data = $group;
        $fields = groups::formFields($group['id']);
        return view('back-office/templates/groups/edit', compact('fields', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param groups $groups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $groups = groups::find($id);

        if (json_decode($request['deteletags'])) {
            foreach (json_decode($request['deteletags']) as $key => $value) {
                groupSessionMembers::where('id_member', '=', $value->member_id)->where('id_session', '=', $groups->id)->delete();
            }
        };
        if (json_decode($request['members'])) {
//            dd($request->toArray());
            foreach (json_decode($request['members']) as $key =>$value)
            {
                    groupSessionMembers::updateOrCreate([
                            'group_id'=> $groups['id'],
                            'id_projet' => $value->project_id,
                            'id_member' => $value->member_id,
                        ]
                    );
                }
        }
        $groups->update([
            'title'=> $request['title'],
        ]);


        return redirect()->intended('admin/groups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Session $session
     * @return string
     * @throws \Exception
     */
    public function destroy(Session $session)
    {
        try{
            $session->delete();

            return response()->json(['message'=>'session supprimé !'],200);

        }
        catch (\Illuminate\Database\QueryException $e){
            return response()->json(['message'=>'Session non supprimer veuillez supprimer les entites liées a la Session'],409);
        }
    }

    public function ajaxGroupsList(Request $request)
    {
        $Formations=groups::select()->where(function ($q) use ($request) {
            $q->where('title', 'LIKE', '%' . $request['generalSearch']  . '%');
        })->get();
        return response()->json([$Formations]);
        //
    }
    public function ajaxProjectlist(Request $request)
    {
        $ProjectApplication=ProjectApplication::select('id','title AS value','description')->
        where('id','=', $request['project_application_id'])
            ->get();


        return response()->json([$ProjectApplication]);
    }

    public function ajaxMemebersProjectList(Request $request)
    {
        $users= Member::join('projects_applications', 'projects_applications.member_id', '=', 'members.id')->
//        get();
//        dd($users);

        where(function ($q) use ($request) {
            $q->orWhere('members.id', 'LIKE', '%' . $request['ProjectApplication'] . '%');
        })->get()->map(function($member){
//

//dd($member->member_id);
            $user=$member ->only(['id','member_id','first_name','last_name']);
            $project=$member ->only(['member_id','title',]);
//            dump($member['title']);

//         dump([
//             'member_id'=>$member['member_id'],
//             'value'=>$user['first_name'].' '. $user['last_name'],
//             'project_id'=>$member->id,
//             'project_title'=>$project['title']
//         ]);
            return [
                'member_id'=>$user['member_id'],
                'value'=>$user['first_name'].' '. $user['last_name'],
                'project_id'=>$member->id,
                'project_title'=>$project['title']
            ];
        });
        $usersapp= ProjectApplicationMember::select('project_application_id','member_id')->

//        get();
//        dd($users);

        where(function ($q) use ($request) {
            $q->orWhere('id', 'LIKE', '%' . $request['ProjectApplication'] . '%');
        })->get()->map(function($member){
//                dump($member);


//                dd($member);
            $user=$member->getUser ->only(['id','first_name','last_name']);

            $project=$member->getProject ->only(['id','title',]);


//         dd([
//             'member_id'=>$member['member_id'],
//             'value'=>$user['first_name'].' '. $user['last_name'],
//             'project_id'=>$member->id,
//             'project_title'=>$project['title']
//         ]);
            return [
                'member_id'=>$user['id'],
                'value'=>$user['first_name'].' '. $user['last_name'],
                'project_id'=>$member->project_application_id,
                'project_title'=>$project['title']
            ];
        });

        $adhprc=ProjectApplication::where('id','=', $request['project_application_id'])->get()->map(function($member){
//           dd($member);
            $user=$member->getAdhname->only(['id','first_name','last_name']);

            return [
                'member_id'=>$user['id'],
                'value'=>$user['first_name'].' '. $user['last_name'],
                'project_id'=>$member->id
            ]; });
//        dump($users);
        foreach ($adhprc as $value) {
            $MyObject =[];
            $MyObject['member_id'] = $value['member_id'];
            $MyObject['value'] = $value['value'];
            $MyObject['project_id'] = $value['project_id'];
            $users[] = $MyObject;
        }
//        $result= [];
//        array_push($result, );
//        array_push($result, $usersapp);
//        $users->push();

        return $users->merge($usersapp);


    }



}
