<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function create_profile() {
        return view('profile.create');
    }

    public function store_profile(Request $request) {

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('profile', 'public');
            
            $profile = new Profile([
                "image" => $request->file->hashName(),
                'first_name' => $request->get('fname'),
                'last_name' => $request->get('lname'),
                'bio' => $request->get('bio'),
                'user_id' => auth()->user()->id,
            ]);
            $profile->save();
        }

        return redirect()->route('home');
    }

    public function show_profile($user_id) {
        
        $user = User::find($user_id);
        return view('profile.show', compact('user'));
    }

    public function edit_profile() {
        $profile = auth()->user()->profile;
        return view('profile.edit', compact('profile'));
    }

    public function update_profile(Request $request) {
        
        $profile = auth()->user()->profile;

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('profile', 'public');
            
            $profile->image = $request->file->hashName();
        }

        $profile->first_name = $request->get('fname');
        $profile->last_name = $request->get('lname');
        $profile->bio = $request->get('bio');
        $profile->save();

        return redirect()->route('home');
    }
}
