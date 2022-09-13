<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Task;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
#Route::post('signup',RegisterController::class);

Route::post('signup','Auth\RegisterController@create');
