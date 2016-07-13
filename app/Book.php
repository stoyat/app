<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $hidden = ['updated_at', 'created_at'];
    //
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot(['id', 'created_at']);
    }
}
