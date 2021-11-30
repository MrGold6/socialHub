<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Message
{
    public function getMessages() {
        $first = DB::table('chats')
            ->where('idUserFirst',  '=', Auth::id())
            ->select('id', 'idUserSecond as idUser')->get();
        $second = DB::table('chats')
            ->where('idUserSecond',  '=', Auth::id())
            ->select('id', 'idUserFirst as idUser')->get();

//        Message::all()->where('idUser', '=', $idUser)->latest();

        $idChats = array();
        foreach($first as $arr){
            $idChats[] = $arr->id;
        }
        foreach($second as $arr){
            $idChats[] = $arr->id;
        }

        $firstUser = DB::table('chats')
            ->where('idUserFirst',  '=', Auth::id())
            ->select('chats.id as idChat', 'idUserSecond as idUser', 'users.id as idUser', 'users.image','users.firstName', 'users.lastName', 'users.middleName')
            ->join('users', 'users.id', '=', 'chats.idUserSecond')
            ->get();
        $secondUser = DB::table('chats')
            ->where('idUserSecond',  '=', Auth::id())
            ->select('chats.id as idChat', 'idUserFirst as idUser',  'users.image','users.firstName', 'users.lastName', 'users.middleName')
            ->join('users', 'users.id', '=', 'chats.idUserFirst')
            ->get();

        $idUser = array();
        foreach($firstUser as $arr){
            $idUser[] = $arr;
        }
        foreach($secondUser as $arr){
            $idUser[] = $arr;
        }

//        dd($idUser);

//        $idUsers[] = Auth::id();
//        dd($idChats);
//        $messageDB = DB::table('messages')
//            ->select('messages.created_at as messageCreate', 'messages.id', 'messages.message', 'messages.idUser', 'messages.idChat', 'messages.viewed', 'users.firstName', 'users.middleName', 'users.lastName', 'users.email',  'users.birthday', 'users.image')
//            ->join('users', 'users.id', '=', 'messages.idUser')
//            ->whereIn('idUser', $idUsers)
//            ->orderBy('messages.id')->get();

//        $temp = DB::select(DB::raw("
//            SELECT m1.*
//            FROM messages m1 LEFT JOIN messages m2
//             ON (m1.idChat = m2.idChat AND m1.id < m2.id)
//            WHERE m2.id IS NULL"));

        $lastMessage = DB::select(DB::raw("
            SELECT m1.*
            FROM messages m1
            LEFT JOIN messages m2
             ON (m1.idChat = m2.idChat AND m1.id < m2.id)
            WHERE m2.id IS NULL
            ORDER BY m1.created_at DESC"));

        $myLastMessage = array();
        foreach($lastMessage as $arr) {
            foreach($idChats as $chat) {
                if($arr->idChat == $chat) {
                    $myLastMessage[] = $arr;
                }
            }
        }

//        dd($myLastMessage);



        return [
            'message' => $myLastMessage,
            'user' => $idUser
        ];


//        $latest = DB::table('messages')
//            ->select('message', 'idUser', 'created_at')
//            ->groupBy('idChat')
//            ->where('created_at', \DB::raw("(select max('created_at') from messages where ))->get();

    }
}
