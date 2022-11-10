<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_page(Request $request) {
        return view('auth.login');
    }

    public function login(Request $request) {

        $users = User::all();
        foreach ($users as $user) {
            if ($user->number == $request->get('number')) {
                if ($user->password == $request->get('password')) {
                    Auth::login($user);
                    if ($user->profile) {
                        return redirect('home');
                    } else  {
                        return redirect('create_profile');
                    }
                }
            }
        }
        return redirect('login_page');
    }

    public function signup_page() {
        return view('auth.signup');
    }

    public function signup(Request $request) {

        $users = User::all();
        foreach ($users as $user) {
            if ($user->number == $request->get('number')) {
                return redirect('signup_page');  
            }
        }
        if ($request->get('password1') != $request->get('password2')) {
            return redirect('signup_page'); 
        }
        $user = new User([
            'username' => $request->get('username'),
            'number' => $request->get('number'),
            'password' => $request->get('password2'),
        ]);
        $user->save();
        Auth::login($user);
        return redirect('create_profile');
    }

    public function logout(Request $request) {

        Auth::logout();
        return redirect('home');
    }
}
