<?php

namespace App\ServiceLera;

use App\Models\GroupUser;
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

    public static function delete($id)
    {
        GroupUser::all()->find($id)->delete();
    }
}
