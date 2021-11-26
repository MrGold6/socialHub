<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\ServiceLera\GroupService;
use App\ServiceLera\GroupUsersService;
use App\ServiceLera\PostService;
use App\ServiceLera\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ValeriiaController extends Controller
{
    public function home()
    {
        return view('valeriia.home', ['Posts' => PostService::getAllFriendPostsByUser(Auth::user()->getAuthIdentifier())]);
    }

    //post
    public function createPostView($id)
    {
        return view('valeriia.forms.createPost', ['Group' => GroupService::getByID($id)]);
    }
    //


    public function createPost(Request $request)
    {

        PostService::create($request);
        return redirect()->route('Group', $request->idGroup);
    }

    public function deletePost($id)
    {
        PostService::delete($id);
        return Redirect::back();
    }

    //group
    public function groups()
    {
        return view('valeriia.groups', ['Groups' => GroupService::getAll()]);
    }

    public function myGroups()
    {
        return view('valeriia.groups', ['Groups' => GroupService::getByOwner(Auth::user()->getAuthIdentifier())]);
    }

    public function group($id)
    {

        return view('valeriia.group', ['Group' => GroupService::getByID($id)],
            [
                'Posts' => PostService::getByGroup($id),
                'UsersCount' => GroupUsersService::getAllGroupUsers($id)->count(),
                'isGroupUser' => GroupUsersService::isGroupUser(Auth::id(),$id)
            ]);
    }

    public function groupUsers($id)
    {
        return view('valeriia.group_users', ['Group' => GroupService::getByID($id)], ['Users' => GroupUsersService::getAllGroupUsers($id)]);

    }
    public function createGroupUser($idUser, $idGroup)
    {
        GroupUsersService::create($idUser, $idGroup);
        return redirect()->route('Group', $idGroup);
    }

    public function deleteUserGroup($idUser, $idGroup)
    {
        GroupUsersService::deleteUserGroup($idUser, $idGroup);
        return redirect()->route('Group', $idGroup);
    }

    public function createGroupView()
    {
        return view('valeriia.forms.create_group');
    }

    public function createGroup(Request $request)
    {
        GroupService::create($request);
        return redirect()->route('myGroups');
    }

    public function updateGroupView($id)
    {

        return view('valeriia.forms.update_group', ['Group' => GroupService::getByID($id)], ['Users' => UserService::getAll()]);
    }

    public function updateGroup(Request $request)
    {
        GroupService::update($request['id'], $request);
        return redirect()->route('Group', $request->id);
    }

    public function deleteGroup($id)
    {
        GroupService::delete($id);
        return redirect()->route('myGroups');

    }
    //
    public function deletePhoto($id)
    {
        GroupService::deletePhoto($id);
        return redirect()->route('Group', $id);

    }

    public function deleteGroupUsers($id)
    {
        GroupUsersService::delete($id);
        return Redirect::back();
    }



}
