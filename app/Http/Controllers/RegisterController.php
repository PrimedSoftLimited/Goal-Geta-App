<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\User;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'email' =>  'required|email|unique:users',
            'phone_number' => 'required|min:8',
            'password'=> 'required|min:6|confirmed',
        ]);

        $generateRandomString = Str::random(60); 

        $token = hash('sha256', $generateRandomString);

        $user = new User();

        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->password = Hash::make($request->input('password'));

        $user->api_token = $token;

        $info = $user->save();
        
        if($info) {
           return response()->json(['data' => ['success' => true, 'message' => 'Registration Successful', 'user' => $user, 'token' => 'Bearer ' . $token ]], 200);
        }else{
            return response()->json(['data' => ['error' => false, 'message' => 'An error  occured!!']], 401);
        }

    
       


        
    }
}
