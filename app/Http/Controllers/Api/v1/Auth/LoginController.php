<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /*
        USER LOGIN
        --------------------------------------
        Seller inputs validating,
        Finding if user exits,
        Password checking (Hashed passwords),
        Create Access Token for the valid user
    */

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            "email" => 'required|email',
            "password" => 'required|string'
        ]);

        $user = User::where('email',$request->email)->first();

        if($user){
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken('Personal Access Token')->accessToken;

                return response()->json([
                    'success' => true,
                    'message' => "OK",
                    'access_token' => $token,
                    "statusCode" => 200
                ]);

            }else{
                return response()->json([
                    "success" => false,
                    "message" => "Passwords doesn't match",
                    "statusCode" => 401
                ]);
            }
        }else{
            return response()->json([
                "success" => false,
                "message" => "User does not exist",
                "statusCode" => 401
            ]);
        }
    }


    /*
        USER LOGOUT
        --------------------------------
        Revoke current user's token
    */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            "success" => true,
            "message" => "Logged out successfully",
        ]);
    }

    /*
        GET CURRENT LOGGED USER
        --------------------------------
    */

    public function getCurrentUser(Request $request)
    {
        return response()->json($request->user());
    }


}
