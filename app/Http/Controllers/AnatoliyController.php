<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AnatoliyController extends Controller
{
    public function friend($id)
    {

        $AllFriendIdArray = $this->searchfriend($id, 1,1);

        $friend = DB::table('users')->select('*')->whereIn('id', $AllFriendIdArray)->get();

        $AllFriendIdArrayRequest = $this->searchfriend($id, 0,0);

        $requestfriend = DB::table('users')->select('*')->whereIn('id', $AllFriendIdArrayRequest)->get();

        return view('anatoliy.friend', ['friends'=>$friend], ['requestsFriends'=>$requestfriend, 'notFriends'=>$this->otherUser()]);

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

}




/*

     @if($friend){
   }@else{
       <div class="text-center nothing">
          <h5>Запитів на дружбу немає</h5>
       </div>
   }
*/
