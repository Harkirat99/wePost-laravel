<?php

use Illuminate\Http\Request;
// use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Task;
use App\Http\Controller\CategoryController;
use App\Http\Controller\PostController;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
#Route::post('signup',RegisterController::class);

// Route::post('signup','Auth\RegisterController@create');
// Route::post('login','Auth\RegisterController@login');
// Route::get('getUser','Auth\RegisterController@details');
// Route::get('search','Auth\RegisterController@getuser');


Route::post('signup','UserController@create');
Route::post('login','UserController@login');
Route::get('getUser','UserController@details');
Route::get('search','UserController@getuser');

Route::get('getAllPosts','CategoryController@show');
Route::get('getpost','PostController@show_category');





