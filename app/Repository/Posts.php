<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Posts
{
    public static function getUserPosts($id){
//        $likes = DB::table('posts')
//            ->join('images', 'images.idPost', '=', 'posts.id')
//            ->join('users', 'users.id', '=', 'posts.idOwner')
//            ->join('likes')->where('likes.idUser', '=', 'users.id')->where('likes.idPost', '=', 'posts.id')
//            ->select('likes.id')->get();
//        $posts = DB::table('posts')
//            ->leftJoin('images', 'images.idPost', '=', 'posts.id')
//            ->join('users', 'users.id', '=', 'posts.idOwner')
//            ->where('users.id', '=', $id)
//            ->select('posts.text as text', 'images.imageName', 'users.firstName', 'users.lastName', 'users.middleName')->get();


        $posts = [];
        $all_post = DB::table('posts')->where('idOwner', '=', $id)->where('idGroup', '=', 0)->orderByDesc('id')->get();

        foreach ($all_post as $post) {
            $item = DB::table('posts')
                ->join('images', 'images.idPost', '=', 'posts.id')
                ->join('users', 'users.id', '=', 'posts.idOwner')
                ->select('posts.id as id', 'posts.text as text', 'images.imageName as image', 'users.id as userId', 'users.firstName', 'users.lastName', 'users.middleName')
                ->where('posts.id', '=', $post->id)
                ->get()->first();

            if($item)
                $posts[] = $item;
            else
                $posts[] = DB::table('posts')
                    ->join('users', 'users.id', '=', 'posts.idOwner')
                    ->select( '*')
                    ->select('posts.id as id', 'posts.text as text',  'users.id as userId', 'users.firstName', 'users.lastName', 'users.middleName')
                    ->where('posts.id', '=', $post->id)
                    ->get()->first();

        }
        return $posts;

    }

    public static function createPost(Request $request) {
        $post = new Post();
        $post->text = $request['text'];
        $post->idOwner = Auth::id();
        $post->idGroup = 0;
        $post->save();

        $image = $request->file('image');

        if($image)
            ImageService::saveImageToFolder($image,'/ImagePost', $post->id);

    }
}
