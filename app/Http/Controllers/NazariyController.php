<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\Users;
use App\Repository\Posts;
use App\Repository\Friends;
use App\Repository\Message;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Friend;

class NazariyController extends Controller
{
    public function userId($id) {
        return view('nazariy.page', ['User' => Users::getUserById($id), 'Posts' => Posts::getUserPosts($id), 'Friend' => Friends::getFriend($id)]);
    }

    public function getMessages()
    {
        return view('nazariy.message', ['Message' => Message::getMessages()]);
    }

    public function createPost(Request $request) {
        Posts::createPost($request);
        return Redirect::back();
        //return view('nazariy.page', ['User' => Users::getUserById(Auth::id()), 'Posts' => Posts::getUserPosts(Auth::id()), 'Friend' => Friends::getFriend(Auth::id())]);
    }

    public function removeFriend(Request $request)
    {
        if($request['firstUser'] == Auth::id()) {
            DB::table('friends')->where('friends.idFirstUser', '=', Auth::id())->where('friends.idSecondUser',  '=', $request['secondUser'])->delete();
        }
        else {
            DB::table('friends')->where('friends.idFirstUser', '=', $request['firstUser'])->where('friends.idSecondUser',  '=', Auth::id())->delete();
        }

        return Redirect::back();
    }

    public function confirmToBeFriend(Request $request)
    {

        $confirmreqst = Friend::all()->where('idFirstUser', '=', $request['firstUser'])->where('idSecondUser',  '=', Auth::id())->first();


        $confirmreqst->confirm = 1;
        $confirmreqst->save();

        return Redirect::back();

    }

    public function sendToBeFriend(Request $request)
    {
        DB::table('friends')->where('friends.idFirstUser', '=', Auth::id())->where('friends.idSecondUser',  '=', $request['secondUser'])->delete();

        return Redirect::back();
    }

    public function makeFriends(Request $request)
    {
        $friend = new Friend();
        $friend->idFirstUser = $request['firstUser'];
        $friend->idSecondUser = $request['secondUser'];
        $friend->confirm = 0;
        $friend->save();

        return Redirect::back();

    }

    public function deletePost(Request $request)
    {
        DB::table('images')->where('images.idPost', '=', $request['post'])->delete();
        DB::table('posts')->where('posts.id', '=', $request['post'])->delete();

        return Redirect::back();

    }

}
