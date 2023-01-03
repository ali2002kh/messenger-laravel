<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicMessage extends Model
{
    use HasFactory;

    protected $gaurded = [
        'id',
    ];

    protected $fillable = [
        'body',
        'sender',
        'receiver',
        'seen',
    ];

    public function sender() {

        // return $this->belongsTo('App\Models\User', 'id', 'sender');

        return User::find($this->sender);
    }

    public function receiver() {

        // return $this->belongsTo('App\Models\Group', 'id', 'receiver');

        return Group::find($this->receiver);
    }

    public function is_sender($user_id) {
        
        $sender = User::all()->where('id', $this->sender)->first();
        if ($sender->id == $user_id) {
            return true;
        }
        return false;
    }
}
