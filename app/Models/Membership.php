<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    public function user() {

        return $this->belongsTo('App\Models\User', 'id', 'sender');
    }

    public function group() {

        return $this->belongsTo('App\Models\Group', 'id', 'receiver');
    }
}
