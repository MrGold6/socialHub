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
    Route::get('user/{id}/chat', [EvgenController::class, 'chat'])->name('chat');
    Route::post('deleteComment', [EvgenController::class, 'deleteComment'])->name('deleteComment');
    Route::post('deleteAnswerComment', [EvgenController::class, 'deleteAnswerComment'])->name('deleteAnswerComment');
    Route::post('createComment', [EvgenController::class, 'createComment'])->name('createComment');
    Route::post('post/like', [EvgenController::class, 'likePost'])->name('likePost');
    Route::post('createAnswerComment', [EvgenController::class, 'createAnswerCommentMain'])->name('createAnswerCommentMain');
    Route::post('createAnswerToAnswer', [EvgenController::class, 'createAnswerToAnswer'])->name('createAnswerToAnswer');
    Route::post('createAnswerToAnswer', [EvgenController::class, 'createAnswerToAnswer'])->name('createAnswerToAnswer');
    Route::post('sendMessage', [EvgenController::class, 'sendMessage'])->name('sendMessage');
    Route::post('refreshChat', [EvgenController::class, 'refreshChat'])->name('refreshChat');




    //nazar
    Route::get('/user/{id}', [NazariyController::class, 'userId'])->name('user');
    Route::get('/messages', [NazariyController::class, 'getMessages'])->name('getMessages');
    Route::post( '/userc',[NazariyController::class, 'createPost'])->name('createPost');
    Route::post( '/user_post_delete',[NazariyController::class, 'deletePost'])->name('deletePost');
    Route::post( '/userd',[NazariyController::class, 'removeFriend'])->name('removeFriend');


        //lera
        //group post

        //group post
    Route::get('/', [ValeriiaController::class, 'home'])->middleware('auth');
    Route::get('/createPostView/{id}', [ValeriiaController::class, 'createPostView'])->name('CreatePostView');
    Route::post('/createPost', [ValeriiaController::class, 'createPost'])->name('CreatePost');
    Route::get('/updateGroupView/{id}', [ValeriiaController::class, 'updateGroupView'])->name('UpdateGroupView');
    Route::post('/updateGroup', [ValeriiaController::class, 'updateGroup'])->name('UpdateGroup');
    Route::get('/updatePostView/{id}', [ValeriiaController::class, 'updateGroupView'])->name('UpdateGroupView');
    Route::post('/updatePost', [ValeriiaController::class, 'updateGroup'])->name('UpdateGroup');
    Route::get('/deletePost/{id}', [ValeriiaController::class, 'deletePost'])->name('DeletePost');
     //groups

    //groups
    Route::get('/groups', [ValeriiaController::class, 'groups'])->name('Groups');
    Route::get('/myGroups', [ValeriiaController::class, 'myGroups'])->name('myGroups');
    Route::get('/Group/{id}', [ValeriiaController::class, 'group'])->name('Group');
    Route::get('/GroupUsers/{id}', [ValeriiaController::class, 'groupUsers'])->name('GroupUsers');
    Route::get('/deleteGroupUsers/{id}', [ValeriiaController::class, 'deleteGroupUsers'])->name('DeleteGroupUsers');
    Route::get('/deleteGroup/{id}', [ValeriiaController::class, 'deleteGroup'])->name('DeleteGroup');
    Route::get('/CreateGroupUser/{idUser}/{idGroup}', [ValeriiaController::class, 'createGroupUser'])->name('CreateGroupUser');
    Route::get('/DeleteUserGroup/{idUser}/{idGroup}', [ValeriiaController::class, 'deleteUserGroup'])->name('DeleteUserGroup');
    Route::get('/createGroupView', [ValeriiaController::class, 'createGroupView'])->name('CreateGroupView');
    Route::post('/createGroup', [ValeriiaController::class, 'createGroup'])->name('CreateGroup');
    Route::get('/deletePhoto/{id}', [ValeriiaController::class, 'deletePhoto'])->name('DeletePhoto');






    //tolik
    Route::get('/user/{id}/friends', [AnatoliyController::class, 'friend'])->name('friends');
    Route::get('/allgroups/{id}/allGroups', [AnatoliyController::class, 'allGroup'])->name('allGroups');
    Route::get('/searchPeoples', [AnatoliyController::class, 'notfriend'])->name('searchPeoples');
    Route::get('/DeleteRequest/{id}', [AnatoliyController::class, 'dellRequest'])->name('DeleteRequest');
    Route::get('/ConfirmRequest/{id}', [AnatoliyController::class, 'confirmRequest'])->name('ConfirmRequest');

    Route::get('/userSettings', [AnatoliyController::class, 'userSetting'])->name('userSettings');
    Route::post('/updateUser', [AnatoliyController::class, 'updateUser'])->name('UpdateUser');


    Route::post('/searchUsersByName', [AnatoliyController::class, 'searchUsers'])->name('searchUsersByName');

//deletePhoto
    Route::get('/deletePhoto', [AnatoliyController::class, 'deletePhoto'])->name('deletePhoto');



});
