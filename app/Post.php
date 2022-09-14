<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    function category(){
//     return $this->belongsTo(Category::class);
//    }
function getCategory(){
    return $this->hasMany('App\Category','category_id','category_id');
}
}
