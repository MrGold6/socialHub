<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Group;
use App\Models\User;
use App\Repository\Friends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AnatoliyController extends Controller
{
    //searchUsers
    public function searchUsers(Request $request){
        $AllFriendIdArrayRequest = Friend::all()->where('confirm', '=', 0);

        return view('anatoliy.searchPeoples',
            ['notFriends'=>$this->otherUser()->where('firstName','=', $request['firstName'])->get()],
                ['requests'=>$AllFriendIdArrayRequest]);
    }
    //searchUsers func

    //start friend func
    public function friend($id)
    {

        $AllFriendIdArray = $this->searchfriend($id, 1,1);

        $friend = DB::table('users')->select('*')->whereIn('id', $AllFriendIdArray)->get();

        $AllFriendIdArrayRequest = $this->searchfriend($id, 0,0);

        $requestfriend = DB::table('users')->select('*')->whereIn('id', $AllFriendIdArrayRequest)->get();

        return view('anatoliy.friend', ['friends'=>$friend], ['requestsFriends'=>$requestfriend]);

    }

    public function notfriend(){
        $AllFriendIdArray = $this->searchfriend( Auth::id(), 1,1);

        $friend = DB::table('users')->select('*')->whereIn('id', $AllFriendIdArray)->get();

        //$AllFriendIdArrayRequest = $this->searchfriend( Auth::id(), 0,0);

        $AllFriendIdArrayRequest = Friend::all()->where('confirm', '=', 0);

        return view('anatoliy.searchPeoples', ['notFriends'=>$this->otherUser()->get()],
            ['requests'=>$AllFriendIdArrayRequest]);
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

        $userNotMyFriend = DB::table('users')->whereNotIn('id', $AllFriendIdArray)->where('id', '<>', Auth::id())->limit(15);

        return $userNotMyFriend;
    }
    //end friend func



    //start groups func

    public function allGroup()
    {

        $group = DB::table('groups')->select('*')->get();

        return view('anatoliy.allGroups', ['groups'=>$group]);

    }



    //end groups func


    //start setting func


    public function userSetting()
    {
        $user = User::all()->where('id', '=',  Auth::id())->first();

        return view('anatoliy.userSetting', ['user'=>$user]);
    }
    public function updateUser(Request $request)
    {
        $user = (new User)::all()->find(Auth::id());
        $user->firstName = $request['firstName'];
        $user->middleName = $request['middleName'];
        $user->lastName = $request['lastName'];
        $user->birthday = $request['birthday'];
        $user->email  = $request['email'];

        $file = $request->file('image');
        $contents = $file->openFile()->fread($file->getSize());
        $user->image = $contents;

        $user->save();

        return redirect()->route('user', Auth::id());
    }
    //deletePhoto
    public function deletePhoto()
    {
        $user = (new User)::all()->find(Auth::id());

        $user->image = null;

        $user->save();

        return redirect()->route('user', Auth::id());
    }
    public static function saveImageToFolder($imageFromForm, $path, $idPost = null, $name = null) {
        if(!$name)
            $name = self::getImageName($imageFromForm);


        $imageFromForm->move(public_path($path), $idPost.'.jpg');
    }
    private static function setRecordInDB($idPost, $name) {
        $image = new Image();
        $image->idPost = $idPost;
        $image->imageName = $idPost.'.jpg';
        $image->save();
    }
    private static function getImageName($image) {
        return $image->getClientOriginalName();
    }


    //end setting func
}





