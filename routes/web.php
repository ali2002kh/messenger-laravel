<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
