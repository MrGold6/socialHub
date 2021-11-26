<?php

namespace App\ServiceLera;

use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupUsersService
{
    public static function getAllGroupUsers($id)
    {
        return DB::table('group_users')
            ->join('users', 'users.id', '=', 'group_users.idUser')
            ->select('group_users.id as id','users.id as usersId', 'users.lastName as lastName', 'users.firstName as firstName', 'users.middleName as middleName')
            ->where('group_users.idGroup','=', $id)
            ->get();
    }

    public static function isGroupUser($idUser, $idGroup)
    {
        if(GroupUser::all()->where('idGroup','=', $idGroup)->
        where('idUser','=', $idUser)->isNotEmpty())
            return true;
        else
            return false;

    }

    public static function create($idUser, $idGroup)
    {
        $groupUser = new GroupUser();
        $groupUser->idUser = $idUser;
        $groupUser->idGroup = $idGroup;
        $groupUser->save();
    }
    public static function deleteUserGroup($idUser, $idGroup)
    {
        DB::table('group_users')->
        where('idUser', '=', $idUser)->
        where('idGroup', '=', $idGroup)->
        delete();
    }

    public static function delete($id)
    {
        GroupUser::all()->find($id)->delete();
    }
}
