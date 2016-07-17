<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['firstname', 'lastname', 'email', 'password',];

    protected $hidden = ['password', 'remember_token',];

    public function books()
    {
        return $this->belongsToMany('App\Book')->withPivot(['id', 'created_at']);
    }

    public function getFullNameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }
}
