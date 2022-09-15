<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
    //get posts with tags
        return $this->belongsToMany(Post::Class);
    
    }
}
     