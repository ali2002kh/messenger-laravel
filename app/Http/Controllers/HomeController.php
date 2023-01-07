<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function chat(Request $request, $target_id) {

        $request->session()->put('prev', 'chat');

        $user = Auth::user();
        $target = User::find($target_id); 

        $sended = Message::all()
        ->where('sender', $user->id)
        ->where('receiver', $target_id);

        $received = Message::all()
        ->where('sender', $target_id)
        ->where('receiver', $user->id);

        $tmps = $received->where('seen', false);
        foreach ($tmps as $tmp) {
            $tmp->seen = true;
            $tmp->save();
        }

        $messages = $sended->union($received)->sortBy('id');

        return view('chat', compact('messages', 'target'));
    }

    public function index(Request $request) {

        $request->session()->put('prev', 'home');
        return view('home');
    }

    public function send_message(Request $request, int $target_id) {

        $user = Auth::user();

        $message = new Message([
            'body' => Crypt::encryptString($request->get('body')),
            'sender' => $user->id,
            'receiver' => $target_id,
            'seen' => false,
        ]);

        $message->save();

        return redirect()->route('chat', $target_id);
    }

    public function clear(Request $request, $target_id) {

        $sended = Message::all()
        ->where('sender', auth()->user()->id)
        ->where('receiver', $target_id);

        $received = Message::all()
        ->where('sender', $target_id)
        ->where('receiver', auth()->user()->id);

        $messages = $sended->union($received)->sortBy('id');
        
        foreach($messages as $m) {
            $m->delete();
        }

        return redirect()->route('chat', $target_id);
    }

    public function delete_Message(Request $request, $message_id) {

        $message = Message::find($message_id);
        $target_id = $message->receiver;
        $message->delete();

        return redirect()->route('chat', $target_id);
    }
}
