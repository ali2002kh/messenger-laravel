<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function chat(Request $request, int $target_id) {

        $user = Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        $all_users = User::all();
        $target = User::find($target_id); 

        $sended = Message::all()
        ->where('sender', $user->id)
        ->where('receiver', $target_id);

        $received = Message::all()
        ->where('sender', $target_id)
        ->where('receiver', $user->id);

        $messages = $sended->union($received)->sortBy('id');

        return view('chat', compact('messages', 'target', 'all_users', 'user', 'users'));
    }

    public function index(Request $request) {

        $user = Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        $all_users = User::all();

        return view('home', compact('user', 'users', 'all_users'));
    }

    public function send_message(Request $request, int $target_id) {

        $user = Auth::user();

        $message = new Message([
            'body' => $request->get('body'),
            'sender' => $user->id,
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

    public function delete_Message(Request $request, int $message_id) {

        $message = Message::all()->find($message_id);
        $target_id = $message->receiver;
        $message->delete();

        return redirect()->route('chat', $target_id);
    }
}
