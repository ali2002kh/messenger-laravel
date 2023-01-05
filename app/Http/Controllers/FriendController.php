<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $user = Auth::user();
        $senders = array();

        $friend_requests = Friend::all()
        ->where('receiver', $user->id)
        ->where('accepted', false)
        ;

        foreach($friend_requests as $friend_request) {

            $senders[] = User::find($friend_request->sender);
        }

        return view("friends", compact('senders'));
    }

    public function search(Request $request) {

        $user = auth()->user();
        $senders = array();

        $friend_requests = Friend::all()
        ->where('receiver', $user->id)
        ->where('accepted', false)
        ;

        foreach($friend_requests as $friend_request) {
            $senders[] = User::find($friend_request->sender);
        }

        $resultByNumber = User::where('number', $request->get('search'));
        $resultByUsername = User::where('username', $request->get('search'));
        $result = $resultByNumber->union($resultByUsername);
        if ($result->count() > 0) {
            $result = $result->first();
        } else {
            $result = false;
        }
        return view("friends", compact('senders', 'result'));
    }

    public function accept(Request $request, $sender_id) {

        $user = Auth::user();

        $friend_request = Friend::where('sender', $sender_id)
        ->where('receiver', $user->id)->first();

        $friend_request->accepted = true;
        $friend_request->save();

        return redirect()->back();
    }

    public function deny(Request $request, $sender_id) {

        $user = Auth::user();

        $friend_request = Friend::where('sender', $sender_id)
        ->where('receiver', $user->id)->first();
        $friend_request->delete();

        return redirect()->back();
    }

    public function remove(Request $request, $target_id) {

        $user = Auth::user();

        $sended = Friend::all()
        ->where('sender', $user->id)
        ->where('receiver', $target_id);

        $received = Friend::all()
        ->where('sender', $target_id)
        ->where('receiver', $user->id);

        $friendship = $sended->union($received)->first();
        $friendship->delete();

        return redirect()->back(); 
    }

    public function send_request(Request $request, $target_id) {

        $user = Auth::user();

        $friend_request = new Friend([
            'sender' => $user->id,
            'receiver' => $target_id,
            'accepted' => false,
        ]);

        $friend_request->save();

        return redirect()->back(); 
    }

    public function undo_request(Request $request, $target_id) {

        $user = Auth::user();

        $friend_request = Friend::where('sender', $user->id)
        ->where('receiver', $target_id)->first();
        $friend_request->delete();

        return redirect()->back(); 
    }
}
