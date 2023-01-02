<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Membership;
use Illuminate\Http\Request;

class GroupController extends Controller {
    
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
                'user_id' => auth()->user(),
                'group_id' => $group->id,
            ]);
            $membership->save();
        }

        return redirect()->route('home');
    }
}
