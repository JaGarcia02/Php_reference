<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PayUService\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class User_Controller extends Controller
{
   
    public function register(Request $request)
    {
        try {

                $fields = $request->validate([
                "name" => "required|string",
                "email" => "required|string|unique:users,email",
                "password" => "required|string|confirmed"
            ]);

            $new_user = User::create([
                'name'=>$fields['name'],
                'email'=>$fields['email'],
                'password'=>bcrypt($fields['password']),
            ]);

            $token = $new_user->createToken("myapptoken")->plainTextToken;

            return response()->json(["message"=>"User Created","payload"=>$token],201);
          
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function login(Request $request) {

        try {
            $fields = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);
    
            // Check email
            $user = User::where('email', $fields['email'])->first();
    
            // Check password
            if(!$user || !Hash::check($fields['password'], $user->password)) {
                return response(["message" => "Bad creds"], 401);
            }else{

                $token = $user->createToken('myapptoken')->plainTextToken;
            
                return response()->json(["message"=>"User Logged in","payload"=>$token], 200);
            }
    

        } catch (\Exception $error) {
            throw $error;
        }
      
    }

    public function logout(Request $request) {
        try {
            auth()->user()->tokens()->delete();

            return [
                'message' => 'Logged out'
            ];
        } catch (\Exception $error) {
            throw $error;
        }
       
    }

   
}
