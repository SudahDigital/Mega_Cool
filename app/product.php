<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use SoftDeletes;
        public function categories(){
        return $this->belongsToMany('App\Category','category_product','product_id','category_id')->withPivot('category_id');
        }

        public function orders(){
        return $this->belongsToMany('App\Order');
        }

        public function groups(){
            return $this->belongsToMany('App\Group','group_product','group_id','product_id')->withPivot('group_id');
        }

        
}
