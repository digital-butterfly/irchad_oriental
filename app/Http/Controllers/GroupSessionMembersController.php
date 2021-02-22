<?php

namespace App\Http\Controllers;

use App\groupSessionMembers;
use Illuminate\Http\Request;

class GroupSessionMembersController extends Controller
{
    public function ajaxList(Request $request)
    {

        $query = $request->get('query');

        $search_term = isset($query['generalSearch']) ? $query['generalSearch'] : '';

        $members = groupSessionMembers::where('group_id', '=', $search_term)->get()->map(function ($member) {

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
}
