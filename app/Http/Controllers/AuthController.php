<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
                    $request->session()->put('login', true);
                    $request->session()->put('user', $user->id);
                    return redirect('home');
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
        $request->session()->put('login', true);
        $request->session()->put('user', $user->id);
        return redirect('home');
    }

    public function logout(Request $request) {

        $request->session()->put('login', false);
        $request->session()->put('user', null);
        return redirect('home');
    }
}
