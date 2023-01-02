<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    protected $gaurded = [
        'id',
    ];

    protected $fillable = [
        'username',
        'number',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function profile() {

        return $this->hasOne('App\Models\Profile');
    }

    public function last_message(int $user_id) {

        $sended = Message::all()
        ->where('sender', $this->id)
        ->where('receiver', $user_id);

        $received = Message::all()
        ->where('sender', $user_id)
        ->where('receiver', $this->id);

        $result = $sended->union($received)->sortByDesc('id');

        if ($result->count() == 0) {
            return false;
        }

        return $result->first();
    }

    public function is_friend($user_id) {

        $sended = Friend::all()
        ->where('sender', $this->id)
        ->where('receiver', $user_id)
        ->where('accepted', true);

        $received = Friend::all()
        ->where('sender', $user_id)
        ->where('receiver', $this->id)
        ->where('accepted', true);

        $friendship = $sended->union($received)->count();
        return $friendship;
    }

    public function requested_to($user_id) {

        return Friend::all()
        ->where('sender', $this->id)
        ->where('receiver', $user_id)->count();
    }

    public function friends() {

        $friends = array();
        $all_users = User::all();
        foreach ($all_users as $u) {
            if ($u->is_friend($this->id)) {
                $friends[] = $u;
            }
        }
        return $friends;
    }

    public function groups() {
        $groups = array();
        $tmps = Membership::all()->where('user_id', $this->id);

        foreach($tmps as $tmp) {
            $groups[] = Group::find($tmp->group_id);
        }

        return $groups;
    }

    public function allHasChatWith() {

        $result = array();
        $all_users = User::all();
        $all_groups = $this->groups();

        foreach ($all_users as $u) {
            if ($u->last_message($this->id)) {
                $result[] = $u;
            }
        }

        foreach ($all_groups as $g) {
            if ($g->last_message()) {
                $result[] = $g;
            }
        }

        usort($result,function($first,$second){
            return $first->last_message($this->id)->created_at < $second->last_message($this->id)->created_at;
        });

        return $result;
    }

    public function menu() {
        return array_unique(array_merge(array_unique(array_merge($this->allHasChatWith(), $this->friends())), $this->groups()));
    }



}
