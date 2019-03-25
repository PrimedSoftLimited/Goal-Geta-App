<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {

        $user = Auth::user();


        return response()->json(['data' => [ 'success' => true, 'user' => $user ]], 200);

    }

    public function update(Request $request)
    {
        // Get the Auth Valid User
        $user = Auth::user();

        $token = $user->api_token;

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|min:8',
            'password'=> '|min:6|confirmed',
        ]);

        // $generateRandomString = Str::random(60); 

        // $token = hash('sha256', $generateRandomString);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');

        $password = Hash::make($request->input('password'));
        // check if password was updated
        if(!empty($password)){

            $user->password = $password;

        }

        $saved = $user->save();

        if ($saved) {
            return response()->json(['data' => ['success' => true, 'message' => 'User Updated!', 'user' => $user, 'token' => 'Bearer ' .$token ]], 200);
        } else{
            
            return response()->json(['data' => ['error' => false, "message" => 'Error, Try Again!']], 401);
            
        }
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

       $this-> validate($request, [
            'password' => 'required|min:6',
       ]);

       $password = $request->input('password');

        //Check if password match
        if(Hash::check($password, $user->password)) {

            $delete = $user->delete();
            if($delete) {

                return response()->json(['data' =>  ['success' => true, 'message' => 'User Deleted!' ]], 200);

            }

        }else{
            return response()->json(['data' => ['error' => false, 'messagee' => "Invalid Password"]], 401);
        }

    }

    // public function upload_avatar(Request $request){

    //     $request->validate([
    //         'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $user = Auth::user();

    //     $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

    //     $request->avatar->storeAs('avatars',$avatarName);

    //     $user->avatar = $avatarName;
    //     $user->save();

    //     return response()->json(['Uploaded Successfully']);

    // }

}