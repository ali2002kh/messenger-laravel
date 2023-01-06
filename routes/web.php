<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', [HomeController::class, 'index'])
->name('home');

//------------------------------------------------------------

Route::get('login_page', [AuthController::class, 'login_page'])
->name('login_page');

Route::post('login', [AuthController::class, 'login'])
->name('login');

Route::get('signup_page', [AuthController::class, 'signup_page'])
->name('signup_page');

Route::post('signup', [AuthController::class, 'signup'])
->name('signup');

Route::get('logout', [AuthController::class, 'logout'])
->name('logout');

//--------------------------------------------------------------

Route::get('/chat/{target_id}', [HomeController::class, 'chat'])
->name('chat');

Route::post('/chat/{target_id}', [HomeController::class, 'send_message'])
->name('send_message');

Route::post('/chat/{target_id}/clear', [HomeController::class, 'clear'])
->name('clear');

Route::post('/chat/{message_id}/delete-message', [HomeController::class, 'delete_message'])
->name('delete_message');

//----------------------------------------------------------------

Route::get('/chat/{group_id}/group', [GroupController::class, 'chat'])
->name('group.chat');

Route::post('/chat/{group_id}/group', [GroupController::class, 'send_message'])
->name('group.send_message');

Route::post('/chat/{public_message_id}/group/delete-message', [GroupController::class, 'delete_message'])
->name('group.delete_message');

//----------------------------------------------------------------

Route::get('/create_profile', [ProfileController::class, 'create_profile'])
->name('create_profile');

Route::post('/store_profile', [profileController::class, 'store_profile'])
->name('store_profile');

Route::get('profile/{user_id}', [profileController::class, 'show_profile'])
->name('show_profile');

Route::get('/edit_profile', [ProfileController::class, 'edit_profile'])
->name('edit_profile');

Route::post('/update_profile', [profileController::class, 'update_profile'])
->name('update_profile');

//----------------------------------------------------------------

Route::get('/friends', [FriendController::class, 'index'])
->name('friend.index');

Route::post('/friends', [FriendController::class, 'search'])
->name('friend.search');

Route::get('/friends/{sender_id}/accept', [FriendController::class, 'accept'])
->name('friend.accept');

Route::get('/friends/{sender_id}/deny', [FriendController::class, 'deny'])
->name('friend.deny');

Route::get('/friends/{target_id}/remove', [FriendController::class, 'remove'])
->name('friend.remove');

Route::get('/friends/{target_id}/send_request', [FriendController::class, 'send_request'])
->name('friend.send_request');

Route::get('/friends/{target_id}/undo_request', [FriendController::class, 'undo_request'])
->name('friend.undo_request');

//----------------------------------------------------------------

Route::get('/group/create', [GroupController::class, 'create'])
->name('group.create');

Route::post('/group', [GroupController::class, 'store'])
->name('group.store');

Route::get('/group/{group_id}', [GroupController::class, 'show'])
->name('group.show');

Route::get('/group/{group_id}/edit', [GroupController::class, 'edit'])
->name('group.edit');

Route::post('/group/{group_id}', [GroupController::class, 'update'])
->name('group.update');

Route::get('/group/{group_id}/leave', [GroupController::class, 'leave'])
->name('group.leave');

Route::get('/group/{group_id}/{user_id}/remove', [GroupController::class, 'remove'])
->name('group.remove');

Route::get('/group/{group_id}/add', [GroupController::class, 'add_page'])
->name('group.add_page');

Route::get('/group/{group_id}/{user_id}/add', [GroupController::class, 'add'])
->name('group.add');