<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
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

    // public function messages() {

    //     return $this->hasMany('App\Models\User');
    // }

}
