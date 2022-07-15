<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $gaurded = [
        'id',
        'user_id'
    ];

    protected $fillable = [
        'bio',
        'image',
        'first_name',
        'last_name',
    ];

    public function user() {

        return $this->belongsTo('App\Models\User');
    }
}
