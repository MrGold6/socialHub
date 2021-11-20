<?php

namespace App\ServiceLera;

use App\Models\Group;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostService
{
    public static function getAllFriendPostsByUser($id)
    {
        return  DB::select(DB::raw("
            SELECT posts.id as id, posts.idGroup as idGroup, COUNT(likes.id) as likess, posts.idOwner as idOwner, posts.text as text, users.lastName as lastName, users.firstName as firstName, users.middleName as middleName
            FROM friends
            JOIN users ON users.id = friends.idSecondUser
            JOIN posts ON friends.idSecondUser = posts.idOwner
            LEFT JOIN likes ON posts.id = likes.idPost
            WHERE friends.idFirstUser = $id
            GROUP BY posts.id ORDER BY likess DESC"));

    }

    public static function getByGroup($id)
    {
        return  DB::select(DB::raw("
            SELECT posts.id as id, COUNT(likes.id) as likess, posts.text as text, posts.idGroup as idGroup, posts.idOwner as idOwner, `groups`.title as titleGroup
            FROM posts
            JOIN `groups` ON `groups`.id= $id
            LEFT JOIN likes ON posts.id = likes.idPost
            WHERE posts.idGroup = $id
            GROUP BY posts.id ORDER BY likess DESC"));
    }
    public static function create(Request $request)
    {
        $post = new Post;
        $post->text = $request['text'];
        $post->idOwner  = $request['idOwner'];
        $post->idGroup = $request['idGroup'];

        $post->save();

    }

    public static function delete($id)
    {
        Post::all()->find($id)->delete();
    }
}
