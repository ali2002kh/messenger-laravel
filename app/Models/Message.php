<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $gaurded = [
        'id',
    ];

    protected $fillable = [
        'body',
        'sender',
        'receiver'
    ];

    public function sender() {

        return $this->belongsTo('App\Models\User', 'id', 'sender');
    }

    public function receiver() {

        return $this->belongsTo('App\Models\User', 'id', 'receiver');
    }
}
