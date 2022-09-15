<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public $successStatus = 200;


    function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            $error = "Unauthorized";
            return response()->json(['error'=>'Unauthorised'], 401); 
         }

        $user = $request->user();
        $success['token'] =  $user->createToken('token')->accessToken;
        $success['message'] = "Login Sucessfully";
        return response()->json(['success'=>$success], $this-> successStatus); 

    }



    function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|',
            'email' => 'required|string|email|unique:users',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
       $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        

       $user = User::create($input);
      
        if($user){
         $success['token'] =  $user->createToken('token')->accessToken;
         $success['message'] = "Registration successfull..";
        return response()->json(['success'=>$success], $this-> successStatus); 
       }
    else{
        $error = "Sorry! Registration is not successfull.";
         return response()->json(['message' => $error]);
    }
    }

    public function details(Request $request){
        $user = Auth::user(); 
         return response()->json(['success' => $user], $this-> successStatus); 
        // $user = $request->user();
        // if($user){
        //     return response()->json(['success user' => $user], $this-> successStatus); 
        // }
        // else{
        //     $error = "user not found";
        //     return response()->json(['message' => $error], $this-> successStatus);
        // }
    }
    // public function getuser(){
    //     return User::all();
    // }

}
