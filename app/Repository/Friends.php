<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Friends
{
    public static function getFriend($id) {
        $confirmToBeFriend = DB::table('friends')
            ->where('friends.confirm', '=', 0)
            ->where('friends.idSecondUser','=', Auth::id())
            ->select('friends.idFirstUser as firstUser')
            ->get();

        $sendToBeFriend = DB::table('friends')
            ->where('friends.confirm', '=', 0)
            ->where('friends.idFirstUser','=', Auth::id())
            ->select('friends.idSecondUser as secondUser')
            ->get();

        $sendRequest2 = DB::table('friends')
            ->join('users', 'users.id', '=', 'friends.idSecondUser')
            ->where('friends.confirm', '=', 0)
            ->where('friends.idSecondUser','=', $id)
            ->select('friends.idFirstUser as firstUser','friends.idSecondUser as secondUser')
            ->get();






        $confirm = DB::table('friends')
            ->where('friends.confirm',  '=', 1)
            ->select('friends.idFirstUser as firstUser', 'friends.idSecondUser as secondUser')
            ->get();

        $all = DB::table('friends')
            ->where('friends.idFirstUser', '=', Auth::id())
            ->where('friends.idSecondUser', '=', $id)
            ->orWhere(function($query) use($id) {
                $query->where('friends.idFirstUser', '=', $id)
                    ->where('friends.idSecondUser', '=', Auth::id());
            })
            ->select('friends.idFirstUser as firstUser', 'friends.idSecondUser as secondUser')
            ->get();

//dd($all);

        return [
            'confirmToBeFriend'=>$confirmToBeFriend,
            'sendToBeFriend'=>$sendToBeFriend,
            'confirm'=>$confirm,
            'all'=>$all,
            'value'=>false
        ];


    }
}
