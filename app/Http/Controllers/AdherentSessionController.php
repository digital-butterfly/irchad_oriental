<?php

namespace App\Http\Controllers;

use App\AdherentSession;
use App\Http\Resources\AdherentSessionCollection;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AdherentSessionController extends Controller
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
            'sort' => ['required', 'string', 'max:255'],
            'observation' => ['required', 'string', 'max:255'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('back-office/templates/session-members/all');
    }

    public function ajaxList(Request $request)
    {

        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '';

        $members = AdherentSession::where('id_session', '=', $search_term)->get()->map(function ($member) {
            $user = $member->getAdhname->only(['id', 'first_name', 'last_name']);
            $project = $member->getParentProject->only('title');
            return [
                'id' => $member['id'],
                'member_id' => $user['id'],
                'title' => $user['first_name'] . ' ' . $user['last_name'],
                'projet' => $project['title'],
                'sort' => $member['sort'],
                'observation' => $member['observation']
            ];
        });
//dd($members->toArray());
        return $members;
    }


    public function ajaxListAdhSess(Request $request)

    {
        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '';
        $role_filter = isset($query['Type']) ? $query['Type'] : '';

//        dd($request->sort['field']);
        $members = new AdherentSessionCollection(AdherentSession::join('members', 'members.id', '=', 'adherent_sessions.id_member')
            ->join('projects_applications', 'projects_applications.id', '=', 'adherent_sessions.id_projet')
            ->join('sessions', 'sessions.id', '=', 'adherent_sessions.id_session')
            ->selectRaw(' adherent_sessions.* , first_name, last_name,sessions.title AS title_session  ,projects_applications.title AS projet')
            ->groupBy('adherent_sessions.id', 'first_name', 'last_name')->where(function ($q) use ($request) {
                if ($request['id_projet']) {
                    $q->where('id_projet', '=', $request['id_projet']);
                }
            })
            ->where(function ($q) use ($search_term, $request) {
                $q->where('adherent_sessions.id', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('members.first_name', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('members.last_name', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('adherent_sessions.id', 'LIKE', '%' . $search_term . '%')
                    ->orWhere('sessions.title', 'LIKE', '%' . $search_term . '%');

            })->
            where(function ($q) use ($role_filter) {
                $role_filter ? $q->whereRaw('LOWER(status) = ?', [$role_filter]) : NULL;
            })->orderBy(
                $request->sort['field'] != 'title' ? $request->sort['field'] : 'members.first_name',
                $request->sort['sort']
            )->
            paginate(
                $perPage = (int)$request->pagination['perpage'],
                $columns = ['*'],
                $pageName = '*',
                $page = $request->pagination['page']
            )
        );
//        dd($members);
        return $members;
    }

    public function edit($id)
    {
//dd($id);
        $data = AdherentSession::findOrFail($id);
        $usename = AdherentSession::findOrFail($id)->getAdhname->only(['id', 'first_name', 'last_name']);
        $fields = AdherentSession::formFields();
        return view('back-office/templates/session-members/edit', compact('fields', 'data', 'usename'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param AdherentSession $adhsee
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all(), 'Adherentsession')->validate();
        $adhsession = AdherentSession::findOrFail($id);
//        dd($adhsee->toArray());

        $adhsession->update([
            'sort' => $request['sort'],
            'observation' => $request['observation'],

        ]);


        return redirect()->intended('admin/session-members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AdherentSession $adhsession
     * @return string
     */
    public function destroy($id)
    {
        $adhsess = AdherentSession::findOrFail($id);
        try {
            $adhsess->delete();

            return response()->json(['message' => 'Utilisateur supprimé de la session !'], 200);

        } catch (QueryException $e) {
            return response()->json(['message' => 'Utilisateur non supprimer veuillez supprimer les entites liées a la Formation'], 409);
        }
    }

}
