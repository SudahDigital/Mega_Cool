<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /*public function pakets(){
        return $this->belongsToMany('App\Paket');
    }*/

    public function products(){
        return $this->belongsToMany('App\product','group_product','group_id','product_id')->withPivot('product_id');
    }
}
