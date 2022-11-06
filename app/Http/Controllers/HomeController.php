<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    public function index(Request $request) {

        if (!Auth::check()) {
            return redirect('login_page');
        }

        $user = Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        $all_users = User::all();

        return view('home', compact('user', 'users', 'all_users'));
    }

    public function chat(Request $request, int $target_id) {

        if (!Auth::check()) {
            return redirect('login_page');
        }

        $users = User::all();
        $user = Auth::user();
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

        if (!Auth::check()) {
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

    public function clear(Request $request, int $target_id) {

        $sended = Message::all()
        ->where('sender', $request->session()->get('user'))
        ->where('receiver', $target_id);

        $received = Message::all()
        ->where('sender', $target_id)
        ->where('receiver', $request->session()->get('user'));

        $messages = $sended->union($received)->sortBy('id');
        
        foreach($messages as $m) {
            $m->delete();
        }

        return redirect()->route('chat', $target_id);
    }
}
