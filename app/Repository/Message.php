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

        $idUsers = array();

        foreach($first as $arr){
            $idUsers[] = $arr->idUser;
        }
        foreach($second as $arr){
            $idUsers[] = $arr->idUser;
        }


        $idUsers[] = Auth::id();
        //dd($idUsers);
        $messageDB = DB::table('messages')
            ->select('messages.created_at as messageCreate', 'messages.id', 'messages.message', 'messages.idUser', 'messages.idChat', 'messages.viewed', 'users.firstName', 'users.middleName', 'users.lastName', 'users.email',  'users.birthday', 'users.image')
            ->join('users', 'users.id', '=', 'messages.idUser')
            ->whereIn('idUser', $idUsers)
            ->orderBy('messages.id')->get();
        //dd($messageDB);
        $messages = array();
        foreach($messageDB as $message)
            $messages[$message->idUser] = $message;

        $messagesChat = array();
        foreach($messageDB as $message)
            $messagesChat[$message->idChat] = $message;

        $sortedArr = collect($messagesChat)->sortBy('messageCreate')->all();
//        dd($sortedArr);

        return $sortedArr;


//        $latest = DB::table('messages')
//            ->select('message', 'idUser', 'created_at')
//            ->groupBy('idChat')
//            ->where('created_at', \DB::raw("(select max('created_at') from messages where ))->get();

    }
}
