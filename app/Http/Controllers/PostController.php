<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
class PostController extends Controller
{
    function show_category(){
        // return Post::find(1)->getCategory;
        return Post::with('getCategory')->get();
        // $result = Post::find(1)->category;
        // return $result;
        
    }
//     function getAllPosts(){
//     $result = Post::find(1)->category;
// }
  
 }
