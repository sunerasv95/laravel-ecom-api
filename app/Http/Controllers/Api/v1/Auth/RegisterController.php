<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|string|confirmed"
        ]);

        $user = new User([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        $result = $user->save();

        if($result){
            return response()->json(array(
                "success" => true,
                "message" => "User created successfully",
                "statusCode" => 201
            ));
        }

        return response()->json(array(
            "success" => false,
            "message" => "Something went wrong",
            "statusCode" => 409
        ));
    }
}
