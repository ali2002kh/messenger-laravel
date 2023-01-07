<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Membership;
use App\Models\PublicMessage;
use Illuminate\Http\Request;

class GroupController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function chat(Request $request, $group_id) {

        $request->session()->put('prev', 'group.chat');
        $request->session()->put('group_id', $group_id);

        $group = Group::find($group_id);
        $user = auth()->user();
        
        $messages = PublicMessage::all()
        ->where('receiver', $group_id);

        $tmps = $messages
        ->where('seen', false)
        ->where('sender', "!=", $user->id);

        foreach ($tmps as $tmp) {
            $tmp->seen = true;
            $tmp->save();
        }

        $contacts = $user->menu();

        return view('group.chat', compact('messages', 'group', 'user', 'contacts'));
    }

    public function send_message(Request $request, int $group_id) {

        $user = auth()->user();

        $message = new PublicMessage([
            'body' => $request->get('body'),
            'sender' => $user->id,
            'receiver' => $group_id,
            'seen' => false,
        ]);

        $message->save();

        return redirect()->route('group.chat', $group_id);
    }

    public function delete_Message($message_id) {

        $message = PublicMessage::find($message_id);
        $group_id = $message->receiver;
        $message->delete();

        return redirect()->route('group.chat', $group_id);
    }

    public function create() {
        return view('group.create');
    }

    public function store(Request $request) {

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('group', 'public');
            
            $group = new Group([
                "image" => $request->file->hashName(),
                'name' => $request->get('name'),
                'info' => $request->get('info'),
            ]);
            $group->save();

            $membership = new Membership([
                'role' => 'owner',
                'user_id' => auth()->id(),
                'group_id' => $group->id,
            ]);
            $membership->save();
        }

        return redirect()->route('home');
    }

    public function show(Request $request, $group_id) {

        $request->session()->put('prev', 'group.show');
        
        $group = Group::find($group_id);
        $members = $group->members();

        return view('group.show', compact('group', 'members'));
    }

    public function edit($group_id) {
        $group = Group::find($group_id);
        return view('group.edit', compact('group'));
    }

    public function update(Request $request, $group_id) {
        
        $group = Group::find($group_id);

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('group', 'public');
            
            $group->image = $request->file->hashName();
        }

        $group->name = $request->get('name');
        $group->info = $request->get('info');
        $group->save();

        return redirect()->route('group.show', $group_id);
    }

    public function leave($group_id) {

        $user = auth()->user();
        $group = Group::find($group_id);
        $group->remove($user->id);

        return redirect()->route('home');
    }

    public function remove($group_id, $user_id) {

        $group = Group::find($group_id);
        $group->remove($user_id);

        return redirect()->route('group.show', $group_id);
    }

    public function add_page($group_id) {

        $friends = auth()->user()->friends();
        $group = Group::find($group_id);
        $friendsNotInGroup = array();

        foreach ($friends as $f) {
            if (!$group->includes($f->id)) {
                $friendsNotInGroup[] = $f;
            }
        }

        return view('group.add', compact('friendsNotInGroup', 'group'));
    }

    public function add($group_id, $user_id) {

        $membership = new Membership([
            'role' => 'member',
            'user_id' => $user_id,
            'group_id' => $group_id,
        ]);
        $membership->save();

        return redirect()->route('group.add_page', $group_id);
    }

}
