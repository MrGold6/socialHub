<?php

use App\Http\Controllers\ValeriiaController;
use App\Http\Controllers\EvgenController;
use App\Http\Controllers\AnatoliyController;
use App\Http\Controllers\NazariyController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::middleware('auth')->group(function () {
    //evgen
    Route::get('post/{id}', [EvgenController::class, 'getPost'])->name('currentPost');
    Route::get('commentAnswer', [EvgenController::class, 'getCommentAnswer'])->name('commentAnswer');
    Route::post('deleteComment', [EvgenController::class, 'deleteComment'])->name('deleteComment');
    Route::post('deleteAnswerComment', [EvgenController::class, 'deleteAnswerComment'])->name('deleteAnswerComment');
    Route::post('createComment', [EvgenController::class, 'createComment'])->name('createComment');
    Route::post('post/like', [EvgenController::class, 'likePost'])->name('likePost');
    Route::post('createAnswerComment', [EvgenController::class, 'createAnswerCommentMain'])->name('createAnswerCommentMain');
    Route::post('createAnswerToAnswer', [EvgenController::class, 'createAnswerToAnswer'])->name('createAnswerToAnswer');



    //nazar
    Route::get('/user/{id}', [NazariyController::class, 'userId'])->name('user');
    Route::get('/messages', [NazariyController::class, 'getMessages'])->name('getMessages');
    Route::post( '/userc',[NazariyController::class, 'createPost'])->name('createPost');
    Route::post( '/user_post_delete',[NazariyController::class, 'deletePost'])->name('deletePost');
    Route::post( '/userd',[NazariyController::class, 'removeFriend'])->name('removeFriend');
    Route::post( '/user',[NazariyController::class, 'confirmToBeFriend'])->name('confirmToBeFriend');
    Route::post( '/usertobe',[NazariyController::class, 'sendToBeFriend'])->name('sendToBeFriend');
    Route::post( '/userm',[NazariyController::class, 'makeFriends'])->name('makeFriends');





    //lera

        //group post
    Route::get('/', [ValeriiaController::class, 'home'])->middleware('auth');
    Route::get('/createPostView/{id}', [ValeriiaController::class, 'createPostView'])->name('CreatePostView');
    Route::post('/createPost', [ValeriiaController::class, 'createPost'])->name('CreatePost');
    Route::get('/updatePostView/{id}', [ValeriiaController::class, 'updateGroupView'])->name('UpdateGroupView');
    Route::post('/updatePost', [ValeriiaController::class, 'updateGroup'])->name('UpdateGroup');
    Route::get('/deletePost/{id}', [ValeriiaController::class, 'deletePost'])->name('DeletePost');

        //groups
    Route::get('/groups', [ValeriiaController::class, 'groups'])->name('Groups');
    Route::get('/myGroups', [ValeriiaController::class, 'myGroups'])->name('myGroups');
    Route::get('/Group/{id}', [ValeriiaController::class, 'group'])->name('Group');
    Route::get('/GroupUsers/{id}', [ValeriiaController::class, 'groupUsers'])->name('GroupUsers');
    Route::get('/deleteGroupUsers/{id}', [ValeriiaController::class, 'deleteGroupUsers'])->name('DeleteGroupUsers');
    Route::get('/deleteGroup/{id}', [ValeriiaController::class, 'deleteGroup'])->name('DeleteGroup');








    //tolik
    Route::get('/user/{id}/friends', [AnatoliyController::class, 'friend'])->name('friends');
    Route::get('/allgroups/{id}/allGroups', [AnatoliyController::class, 'allGroup'])->name('allGroups');
    Route::get('/usersettings/{id}/userSettings', [AnatoliyController::class, 'userSetting'])->name('userSettings');
    Route::get('/searchpeoples/{id}/searchPeoples', [AnatoliyController::class, 'notfriend'])->name('searchPeoples');
    Route::get('/DeleteRequest/{id}', [AnatoliyController::class, 'dellRequest'])->name('DeleteRequest');
    Route::get('/ConfirmRequest/{id}', [AnatoliyController::class, 'confirmRequest'])->name('ConfirmRequest');




});
