<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AnatoliyController extends Controller
{

    //start friend func
    public function friend($id)
    {

        $AllFriendIdArray = $this->searchfriend($id, 1,1);

        $friend = DB::table('users')->select('*')->whereIn('id', $AllFriendIdArray)->get();

        $AllFriendIdArrayRequest = $this->searchfriend($id, 0,0);

        $requestfriend = DB::table('users')->select('*')->whereIn('id', $AllFriendIdArrayRequest)->get();

        return view('anatoliy.friend', ['friends'=>$friend], ['requestsFriends'=>$requestfriend]);

    }

    public function notfriend($id){
        $AllFriendIdArray = $this->searchfriend($id, 1,1);

        $friend = DB::table('users')->select('*')->whereIn('id', $AllFriendIdArray)->get();

        $AllFriendIdArrayRequest = $this->searchfriend($id, 0,0);

        return view('anatoliy.searchPeoples', ['notFriends'=>$this->otherUser()]);
    }

    public function searchfriend($id, $comfirm1, $comfirm2)
    {
        $friendWhereIamFirstUser = DB::table('friends')
            ->select('friends.idFirstUser as id')
            ->where('friends.idSecondUser', '=', $id)
            ->where('confirm', '=', $comfirm1)->get()->toArray();


        $friendWhereIamSecondUser = DB::table('friends')
            ->select('friends.idSecondUser as id')
            ->where('friends.idFirstUser', '=', $id)
            ->where('confirm', '=', $comfirm2)->get()->toArray();

        $AllFriendIdArray = [];
        $AllFriendId = array_merge($friendWhereIamFirstUser, $friendWhereIamSecondUser);
        foreach ($AllFriendId as $friend)
            $AllFriendIdArray[] = $friend->id;


        return $AllFriendIdArray;

    }

    public function dellRequest($id)
    {

        DB::table('friends')->where('friends.idFirstUser', '=', $id)->where('friends.idSecondUser',  '=', Auth::id())->delete();

        return Redirect::back();

    }

    public function confirmRequest($id)
    {

        $confirmreqst = Friend::all()->where('idFirstUser', '=', $id)->where('idSecondUser',  '=', Auth::id())->first();


        $confirmreqst->confirm = 1;
        $confirmreqst->save();

        return Redirect::back();

    }

    public function otherUser() {
        $id = Auth::id();
        $friendWhereIamFirstUser = DB::table('friends')
            ->select('friends.idFirstUser as id')
            ->where('friends.idSecondUser', '=', $id)
            ->where('confirm', '=', 1)->get()->toArray();


        $friendWhereIamSecondUser = DB::table('friends')
            ->select('friends.idSecondUser as id')
            ->where('friends.idFirstUser', '=', $id)
            ->where('confirm', '=', 1)->get()->toArray();

        $AllFriendId = array_merge($friendWhereIamFirstUser, $friendWhereIamSecondUser);

        $AllFriendIdArray =[];
        foreach ($AllFriendId as $friend)
            $AllFriendIdArray[] = $friend->id;

        $userNotMyFriend = DB::table('users')->whereNotIn('id', $AllFriendIdArray)->where('id', '<>', Auth::id())->limit(15)->get();

        return $userNotMyFriend;
    }
    //end friend func



    //start groups func

    public function allGroup()
    {

        $group = DB::table('groups')->select('*')->get();

        return view('anatoliy.allGroups', ['groups'=>$group]);

    }
/*
    public function group($id)
    {

        return view('anatoliy.allGroups', ['Group' => GroupService::getByID($id)], ['Posts' => PostService::getByGroup($id), 'UsersCount' => GroupUsersService::getAllGroupUsers($id)->count()]);
    }
                        <a href="{{route('GroupUsers', $Group->id)}}">
                            <p>Count - {{$UsersCount}}</p>
                        </a>
*/




    //end groups func


    //start setting func

    public function userSetting()
    {

        $setting = DB::table('users')->select('*')->where('id', '=',  Auth::id())->get();

        return view('anatoliy.userSetting', ['settings'=>$setting]);

    }

    //end setting func
}





