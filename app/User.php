<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ['updated_at', 'created_at'];
    //
    public function books()
    {
        return $this->belongsToMany('App\Book')->withPivot(['id', 'created_at']);
    }

    public function getFullNameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }
}
