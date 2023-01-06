<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'info'
    ];

    public function members() {

        $members = array();
        $tmps = Membership::all()->where('group_id', $this->id);

        foreach($tmps as $tmp) {
            $members[] = User::find($tmp->user_id);
        }

        return $members;
    }

    public function members_count() {
        return sizeof($this->members());
    }

    public function remove($user_id) {
        $membership = Membership::all()
        ->where('group_id', $this->id)
        ->where('user_id', $user_id)
        ->first();
        ;

        if ($membership->role == 'owner') {
            $group = Group::find($membership->group_id);
            PublicMessage::where('receiver', $group->id)->delete();
            Membership::where('group_id', $group->id)->delete();
            $group->delete();
            return 0;
        }

        $membership->delete();
    }

    public function includes($user_id) {
        return Membership::all()
        ->where('group_id', $this->id)
        ->where('user_id', $user_id)
        ->count();
    }

    public function last_message($just_for_debug) {

        $result = PublicMessage::all()
        ->where('receiver', $this->id)
        ->sortByDesc('id');

        if ($result->count() == 0) {
            return false;
        }

        return $result->first();
    }

    public function is_user() {
        return false;
    }

    public function name() {
        return $this->name;
    }

}
