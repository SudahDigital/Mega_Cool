<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'image', 'position'
    ];
}
