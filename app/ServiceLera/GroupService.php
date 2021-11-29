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

    public static function getByName($name)
    {
        return Group::all()->where('title','=', $name);
    }

    public static function getByOwner($id)
    {
        return Group::all()->where('idUserOwner','=', $id);

    }

    public static function create(Request $request)
    {
        $group = new Group();
        $group->title = $request['title'];
        $group->description = $request['description'];

        $imageU = $request->file('upload_file');
        $name = $request->file('upload_file')->getClientOriginalName();
        $imageU->move(public_path('/ImageGroup'), $name);
        $group->image = $name;

        $group->idUserOwner  = $request['idUserOwner'];
        $group->save();
    }

    public static function update($id, Request $request)
    {
        $group = (new Group)::all()->find($id);
        $group->title = $request['title'];
        $group->description = $request['description'];
        if($request['upload_file']) {
            $imageU = $request->file('upload_file');
            $name = $request->file('upload_file')->getClientOriginalName();
            $imageU->move(public_path('/ImageGroup'), $name);
            $group->image = $name;
        }
        $group->idUserOwner  = $request['idUserOwner'];
        $group->save();
    }

    public static function delete($id)
    {
        DB::table('posts')->where('posts.idGroup', '=',  $id)->delete();
        Group::all()->find($id)->delete();
    }

    public static function deletePhoto($id)
    {
        $group = (new Group)::all()->find($id);
        $group->image = "";
        $group->save();
    }


}
