<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//    function category(){
//     return $this->belongsTo(Category::class);
//    }
function getCategory(){
    return $this->hasMany('App\Category','category_id','category_id');
}


public function tags()
{

    return $this->belongsToMany(Tag::Class);

}

}
