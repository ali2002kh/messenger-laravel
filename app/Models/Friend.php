<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    public function sender() {

        return $this->belongsTo('App\Models\User', 'id', 'sender');
    }

    public function receiver() {

        return $this->belongsTo('App\Models\User', 'id', 'receiver');
    }
}
