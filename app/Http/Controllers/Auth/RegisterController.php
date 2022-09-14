<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User;
     */
    //  function create(Request $data)
    // {
    //     return User::create([
            
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }   
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
        $user = Auths::user(); 
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
    public function getuser(){
        return User::all();
    }
 
}