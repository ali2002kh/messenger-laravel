<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index(Request $request) {

        if (!$request->session()->get('login')) {
            return redirect('login_page');
        }

        $user = User::find($request->session()->get('user'));
        $users = User::where('id', '!=', $user->id)->get();

        return view('home', compact('user', 'users'));
    }

    public function chat(Request $request, int $target_id) {

        if (!$request->session()->get('login')) {
            return redirect('login_page');
        }

        $users = User::all();
        $user = User::find($request->session()->get('user'));
        $target = User::find($target_id);

        $sended = Message::all()
        ->where('sender', $user->id)
        ->where('receiver', $target_id);

        $received = Message::all()
        ->where('sender', $target_id)
        ->where('receiver', $user->id);

        $messages = $sended->union($received)->sortBy('id');

        return view('chat', compact('messages', 'target', 'users'));
    } 

    public function send_message(Request $request, int $target_id) {

        if (!$request->session()->get('login')) {
            return redirect('login_page');
        }

        $message = new Message([
            'body' => $request->get('body'),
            'sender' => $request->session()->get('user'),
            'receiver' => $target_id
        ]);

        $message->save();

        return redirect()->route('chat', $target_id);
    }
}
