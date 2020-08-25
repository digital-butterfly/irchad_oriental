<?php

namespace App\Http\Controllers;

use App\Adherensession;
use App\AdherentSession;
use App\Formation;
use App\ProjectApplication;
use App\ProjectApplicationMember;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Session;
use App\Http\Resources\SessionCollection;


class SessionController extends Controller
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
            'max_inscrit' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'max:255'],
            'end_date' => ['required', 'date', 'max:255'],
            'sort' => ['required', 'string', 'max:255'],
            'observation' => ['required', 'string', 'max:255'],

        ]);
    }
    public function show()
    {
        $value=null;
        $fields = Session::formFields($value);
        return view('back-office/templates/session/all-calendar', compact("fields"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-office/templates/session/all');
    }

    /**
     * Add new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $value=null;
        $fields = Session::formFields($value);
        return view('back-office/templates/session/add', compact("fields"));
    }
    public function store(Request $request)
    {
//        dd($request->toArray());

        if ($request['projet']!=null){
 if ($request['session']==='auto'){
     $session=Session::create([
         'title'=> 'Session '. Formation::findOrFail($request['id_formation'])->only('title')['title'].' '. ((int) Session::where('id_formation','=',$request['id_formation'])->get()->Count() + 1),
         'id_formation' => $request['id_formation'],
         'max_inscrit' =>10,
         'start_date' => $request['start_date'],
         'end_date' => $request['end_date'],
         'sort' => $request['sort'],
         'observation' => $request['observation'],

     ]);

     if (json_decode($request['members-tagify'])) {
         foreach (json_decode($request['members-tagify']) as $key =>$value)
         {

         AdherentSession::updateOrCreate([
                 'id_session'=> $session['id'],
                 'id_projet' => $request['projet'],
                 'id_member' => $value->member_id,
             ]
         );

     }
     }
 }else{


     if (json_decode($request['members-tagify'])) {
         foreach (json_decode($request['members-tagify']) as $key =>$value)
         {

         AdherentSession::updateOrCreate([
                 'id_session'=> $request['session'],
                 'id_projet' => $request['projet'],
                 'id_member' => $value->member_id,
             ]
         );


     }
     }
 }


        }
        else {
            $this->validator($request->all(), 'session')->validate();
            $countses= (int) Session::where('id','=',$request['id_formation'])->get()->Count();
            $session=Session::create([
                'title'=> 'Session '. Formation::findOrFail($request['id_formation'])->only('title')['title'].' '. ((int) Session::where('id_formation','=',$request['id_formation'])->get()->Count() + 1),
                'id_formation' => $request['id_formation'],
                'max_inscrit' =>$request['max_inscrit'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'sort' => $request['sort'],
                'observation' => $request['observation'],

            ]);

            if (json_decode($request['members'])) {
//            dd($request->toArray());
                foreach (json_decode($request['members']) as $key =>$value)
                {
//                dd($value->member_id);

                    AdherentSession::updateOrCreate([

                            'id_session'=> $session['id'],
                            'id_projet' => $value->project_id,
                            'id_member' => $value->member_id,

                        ]
                    );
                }
            }
        }




        return redirect()->intended('admin/session');
    }

    public function ajaxList(Request $request)
    {
//        dd($request->toArray());

        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '' ;

        $role_filter = isset($query['Type']) ? $query['Type'] : '' ;;
            $sessions=new SessionCollection(Session::
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

    public function edit(Session $session)
    {
        $data = $session;
        $fields = Session::formFields($session['id']);
        return view('back-office/templates/Session/edit', compact('fields', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Session $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        if (json_decode($request['deteletags'])) {
            foreach (json_decode($request['deteletags']) as $key => $value) {

                AdherentSession::where('id_member', '=', $value->member_id)->where('id_session', '=', $session->id)->delete();
            }};
        if (json_decode($request['members'])) {
//            dd($request->toArray());
            foreach (json_decode($request['members']) as $key =>$value)
            {
//                dd($value->member_id);

                AdherentSession::updateOrCreate([

                        'id_session'=> $session['id'],
                        'id_projet' => $value->project_id,
                        'id_member' => $value->member_id,

                    ]
                );
            }
        }
        $session->update([

            'id_formation' => $request['id_formation'],
            'max_inscrit' =>$request['max_inscrit'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'description' => $request['description'],
            'domaine' => $request['domaine'],

        ]);

        return redirect()->intended('admin/session');
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

    public function ajaxFormationList(Request $request)
    {
        $Formations=Formation::select()->where(function ($q) use ($request) {
            $q->where('title', 'LIKE', '%' . $request['generalSearch']  . '%');
        })->get();
        return response()->json([$Formations]);
        //
}
    public function ajaxProjectlist(Request $request)
    {
        $ProjectApplication=ProjectApplication::select('id','title AS value','description')->where('Status','=','Accepté')->where(function ($q) use ($request) {
            $q->where('title', 'LIKE', '%' . $request['ProjectApplication']  . '%')
                ->orWhere('id', 'LIKE', '%' . $request['ProjectApplication'] . '%');
        })->get();


        return response()->json([$ProjectApplication]);
    }

  public function ajaxMemebersProjectList(Request $request)
    {
       $users= ProjectApplicationMember::select('project_application_id','member_id')->where('project_application_id','=', $request['project_application_id'])->get()->map(function($member){
            $user=$member->getUser ->only(['id','first_name','last_name']);

            return [
                'member_id'=>$user['id'],
                'value'=>$user['first_name'].' '. $user['last_name'],
                'project_id'=>$member->project_application_id
                           ];
        });
//       dd($users);
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

        return $users;


    }

}
