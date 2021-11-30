<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Comment;
use App\Models\CommentAnswer;
use App\Models\Like;
use App\Models\Post;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvgenController extends Controller
{
    public function getPostComments($postId) {
        $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.idUser')
            ->select('comments.id as id', 'comments.comment as comment', 'comments.idPost as idPost', 'comments.idUser as idUser', 'users.id as userId', 'users.firstName as firstName', 'users.middleName as middleName', 'users.lastName as lastName', 'users.image as image')
            ->where('idPost', '=', $postId)
            ->orderByDesc('comments.id')->get();

        foreach ($comments as $comment)
            $comment->countAnswer = DB::table('comment_answers')->where('idMainComment', '=', $comment->id)->count();

        return $comments;
    }
    public function getCommentAnswer(Request $request) {
        if($request['typeOfAnswer'] == 'mainComment')
            $comments = DB::table('comment_answers')
                ->join('users', 'users.id', '=', 'comment_answers.idUser')
                ->select('comment_answers.idUser as idUser', 'comment_answers.id as id', 'comment_answers.comment as comment', 'comment_answers.idMainComment as idMainComment', 'comment_answers.idAnswerComment as idAnswerComment', 'users.id as userId', 'users.firstName as firstName', 'users.middleName as middleName', 'users.lastName as lastName', 'users.image as image')
                ->where('idMainComment', '=', $request['idMainComment'])
                ->where('idAnswerComment', '=', 0)->get();
        else
            $comments = DB::table('comment_answers')
                ->where('idMainComment', '=', $request['idMainComment'])
                ->join('users', 'users.id', '=', 'comment_answers.idUser')
                ->select('comment_answers.idUser as idUser', 'comment_answers.id as id', 'comment_answers.comment as comment', 'comment_answers.idMainComment as idMainComment', 'comment_answers.idAnswerComment as idAnswerComment', 'users.id as userId', 'users.firstName as firstName', 'users.middleName as middleName', 'users.lastName as lastName', 'users.image as image')
                ->where('idAnswerComment', '=', $request['id'])->get();

        foreach ($comments as $comment)
            $comment->countAnswer = DB::table('comment_answers')
                ->where('idMainComment', '=', $request['idMainComment'])
                ->where('idAnswerComment', '=', $comment->id)->count();

        return view('evgen.commentsAnswer', ['Comments' => $comments])->render();
    }
    public function getPost($id) {
        $post = DB::table('posts')
            ->where('id', '=', $id)->first();
        $countLike = $this->getCountLikeOnPost($id);
        $comments = $this->getPostComments($id);
        $images = DB::table('images')
            ->where('idPost', '=', $id)->get();
        $myLike = DB::table('likes')->where('idPost', '=', $post->id)->where('idUser', '=', Auth::id())->count() > 0 ? true : false;

        return view('evgen.post', ['post' => $post, 'countLike' => $countLike, 'myLike' => $myLike, 'comments' => $comments, 'Images' => $images]);
    }
    public function createComment(Request $request) {
        $comment = new Comment();
        $comment->comment = $request['comment'];
        $comment->idPost = $request['idPost'];
        $comment->idUser = Auth::id();
        $comment->save();
        $comment->image = Auth::user()->image;
        $comment->firstName = Auth::user()->firstName;

        return view('evgen.comments', ['Comments' => [$comment], 'postId' => $request['idPost']])->render();
    }
    public function deleteComment(Request $request) {
        if($request['type'] == 'main') {
            DB::table('comment_answers')->where('idMainComment', '=', $request['id'])->delete();
            DB::table('comments')->where('id', '=', $request['id'])->delete();
        }
        else
            DB::table('comment_answers')->where('id', '=', $request['id'])->delete();
    }
    public function createAnswerCommentMain(Request $request) {
        $commentAnswer = new CommentAnswer();
        $commentAnswer->idMainComment = $request['idMainComment'];
        $commentAnswer->comment = $request['comment'];
        $commentAnswer->idAnswerComment = 0;
        $commentAnswer->idUser = Auth::id();
        $commentAnswer->save();
        $commentAnswer->image = Auth::user()->image;
        $commentAnswer->firstName = Auth::user()->firstName;

        return view('evgen.commentsAnswer', ['Comments' => [$commentAnswer]])->render();
    }
    public function createAnswerToAnswer(Request $request) {
        $commentAnswer = new CommentAnswer();
        $commentAnswer->comment = $request['comment'];
        $commentAnswer->idMainComment = $request['idMainComment'];
        $commentAnswer->idAnswerComment = $request['idAnswerComment'];
        $commentAnswer->idUser = Auth::id();
        $commentAnswer->save();
        $commentAnswer->image = Auth::user()->image;
        $commentAnswer->firstName = Auth::user()->firstName;

        return view('evgen.commentsAnswer', ['Comments' => [$commentAnswer]])->render();
    }
    public function likePost(Request $request) {
        $idUser = Auth::id();
        $idPost = $request['idPost'];

        $like = Like::all()->where('idUser', '=', $idUser)->where('idPost', '=', $idPost)->first();
        if($like) {
            $like->delete();
            return [false, $this->getCountLikeOnPost($idPost)];
        } else {
            $like = new Like();
            $like->idUser = $idUser;
            $like->idPost = $idPost;
            $like->save();
            return [true, $this->getCountLikeOnPost($idPost)];
        }
    }
    private function getCountLikeOnPost($id) {
        return DB::table('likes')->where('idPost', '=', $id)->count();
    }
    public function chat($id) {
        $idChat = $this->checkChat($id, Auth::id());

        $messages = DB::table('messages')->join('users', 'users.id', '=', 'messages.idUser')
            ->select('messages.id as messageId', 'messages.message as message', 'messages.idUser as ownerMessage', 'users.id', 'users.firstName as firstName', 'users.middleName as middleName', 'users.image as ownerImage')
            ->orderBy('messages.id')
            ->where('idChat', '=', $idChat)->get();

        $user = DB::table('users')->find($id);
        return view('evgen.chat', ['messages' => $messages, 'user' => $user, 'chat' => $idChat]);
    }
    public function sendMessage(Request $request) {
        $message = new \App\Models\Message();
        $message->message = $request['message'];
        $message->idUser = Auth::id();
        $message->idChat = $request['chat'];
        $message->viewed = 0;
        $message->save();
        $user = DB::table('users')->find(Auth::id());
        $message->ownerMessage = Auth::id();
        $message->ownerImage = $user->image;

        return [view('evgen.message', ['message' => $message, 'user' => null])->render(), $message->id];
    }
    public function refreshChat(Request $request) {
        $messages = DB::table('messages')->join('users', 'users.id', '=', 'messages.idUser')
            ->select('messages.id as messageId', 'messages.message as message', 'messages.idUser as ownerMessage', 'users.id', 'users.firstName as firstName', 'users.middleName as middleName', 'users.image as ownerImage')
            ->orderBy('messages.id')
            ->where('idChat', '=', $request['chat'])->where('messages.id', '>', $request['lastMessageId'])->get();
        if($request['lastMessageId'] == $messages[count($messages) - 1]->messageId)
            return null;
        $user = DB::table('users')->find($request['userId']);
        if(count($messages) > 0)
            return [view('evgen.chatMessages', ['messages' => $messages, 'user' => $user])->render(), $messages[count($messages) - 1]->messageId];
        return null;
    }
    private function checkChat($userId, $myId) {
        $id = DB::table('chats')->whereIn('idUserFirst', [$userId, $myId])->whereIn('idUserSecond', [$userId, $myId])->select('id')->first();
        if(!isset($id)) {
            if($myId != $userId)
                return $this->generateChat($myId, $userId);
            else
                abort(404);
        }
        return $id->id;
    }
    private function generateChat($idFirstUser, $idSecondUser) {
        $chat = new Chat();
        $chat->idUserFirst = $idFirstUser;
        $chat->idUserSecond = $idSecondUser;
        $chat->save();
        return $chat->id;
    }
}
