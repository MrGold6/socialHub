<?php

namespace App\ServiceLera;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class GroupService
{
    public static function getAll()
    {
        return Group::all();
    }

    public static function getByID($id)
    {
        return Group::all()->find($id);
    }

    public static function getByOwner($id)
    {
        return Group::all()->where('idUserOwner','=', $id);

    }

    public static function update($id, Request $request)
    {
        $post = (new Group)::all()->find($id);
        $post->title = $request['title'];
        $post->description = $request['description'];
        if($request['upload_file']) {
            $imageU = $request->file('upload_file');
            $name = $request->file('upload_file')->getClientOriginalName();
            $imageU->move(public_path('/ImageGroup'), $name);
            $post->image = $name;
        }
        $post->idUserOwner  = $request['idUserOwner'];
        $post->save();
    }

    public static function delete($id)
    {
        DB::table('posts')->where('posts.idGroup', '=',  $id)->delete();
        Group::all()->find($id)->delete();
    }

}
