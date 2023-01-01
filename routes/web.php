<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendController;
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
->name('friends');

Route::post('/friends', [FriendController::class, 'searched'])
->name('friends_searched');

Route::post('/friends/{sender_id}/accept', [FriendController::class, 'accept'])
->name('accept');

Route::post('/friends/{sender_id}/deny', [FriendController::class, 'deny'])
->name('deny');

Route::post('/friends/{target_id}/remove', [FriendController::class, 'remove'])
->name('remove');

Route::post('/friends/{target_id}/send_request', [FriendController::class, 'send_request'])
->name('send_request');

Route::post('/friends/{target_id}/undo_request', [FriendController::class, 'undo_request'])
->name('undo_request');

