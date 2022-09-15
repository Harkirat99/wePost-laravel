<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function show_category(){
        // return Post::find(1)->getCategory;
        return Post::with('getCategory')->get();
        // $result = Post::find(1)->category;
        // return $result;
        
    }

    public function getPostCategory(Request $req){

        $param = $req->only('url');
        $url = $param['url'];
        if($url){
            $query = Post::query();

            $query->where('url','=',$url);
    
            $query->with('tags','getCategory');
    
            $data = $query->get();
    
            return $data;
        }else{

            return ["Please Pass url"];
            
        }     
    }
  
    public function createPost(Request $req){
        $post = new Post;
         $post->user_id=$req->user_id;
        $post->title=$req->title;
        $post->description=$req->description;
        $post->image=$req->image;
        $post->url=$req->url;
        $post->category_id=$req->category_id;
        $result = $post->save();
        if($result){
            return ["Result"=>"Data Has Been SAVED"];
        }
        else {
            return ["Result"=>"Some Error Occured"];
        }
    }

    public function updatePost(Request $req){

        $currentUserDetails = Auth::user(); 
        $currentUserId = $currentUserDetails->id;

        $postUserDetails = Post::find($req->id);
        
        $postUserId = $postUserDetails->user_id;

        if($currentUserId == $postUserId){
          
            $postUserDetails->user_id=$req->user_id;
            $postUserDetails->title=$req->title;
            $postUserDetails->description=$req->description;
            $postUserDetails->image=$req->image;
            $postUserDetails->url=$req->url;
            $postUserDetails->category_id=$req->category_id;
            $result = $postUserDetails->save();
            
            if($postUserDetails){
                return ["Result"=>"Data Has Been Updated"];
            }
            else{
                return  ["Result"=>"Some Error Occured"];
            }   

        }else{
            return ["Message"=>"Soory you are not authorised to edit this post!"];
        }
    }
 }