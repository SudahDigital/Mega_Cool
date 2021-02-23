<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{   
    protected $table = "customers";
 
    protected $fillable = ['store_code','name','email','phone','store_name','address','payment_term'];

    public function users(){
        return $this->belongsTo('App\User','user_id');
    }

}
