<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index() {

        $user = Auth::user();
        $senders = array();

        $friend_requests = Friend::all()
        ->where('receiver', $user->id)
        ->where('accepted', false)
        ;

        foreach($friend_requests as $friend_request) {

            $senders[] = User::find($friend_request->sender)->profile;
        }

        return view("friends", compact('senders'));
    }

    public function searched(Request $request) {

        $user = Auth::user();
        $senders = array();

        $friend_requests = Friend::all()
        ->where('receiver', $user->id)
        ->where('accepted', false)
        ;

        foreach($friend_requests as $friend_request) {
            $senders[] = User::find($friend_request->sender)->profile;
        }

        $resultByNumber = User::where('number', $request->get('search_field'));
        $resultByUsername = User::where('username', $request->get('search_field'));
        $result = $resultByNumber->union($resultByUsername)->first()->profile;

        return view("friends", compact('senders', 'result'));
    }
}
