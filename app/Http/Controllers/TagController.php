<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;

class TagController extends Controller
{
    public function getPostWithTags()
    {           
         $posts = Post::with('tags','getCategory')->get();

       // return view("posts.index", compact("posts"));
        return $posts;
       
    
}
}