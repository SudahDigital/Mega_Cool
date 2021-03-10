<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function pakets(){
        return $this->belongsToMany('App\Paket');
    }
}
