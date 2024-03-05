<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\SubAdmin;

class SubAdminController extends Controller
{
    public function __construct(){
        Config::set("auth.defaults.guard","subadmin-api");
    }

    public function login (Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required','email'],
            'password'=> ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],422);
        }
        if(!$token = auth()->attempt($validator->validate())) {
            return response()->json(['error'=> 'Unauthorized'],401);
        }
        return response()->json(['token'=> $token, 'token_type' => 'bearer', 'user' => auth()->user()],200);
    }
    
    public function register (Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:sub_admins',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()],422);
        }
        $user = SubAdmin::create(array_merge(
            $validator->validate() , 
            ['password' => bcrypt($request->password)]
        ));

        return response()->json(['message' => 'Sub-Admin Successfully Registred', 'user' => $user],200);
    }

    public function userProfile (Request $request){
        return response()->json((auth()->user()));
    }

    public function logout (){
        auth()->logout();
        return response()->json(['message'=> 'Sub-Admin Logged Out!!'],200);
    }
}
