<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    public function register(RegisterRequest $request)
    {


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('myApp')->accessToken;

        return $this->successResponse([
            'user' => $user,
            'token' => $token
        ], 201);
    }






    public function login(LoginRequest $request)
    {

        $user = User::where('email' , $request->email)->first();

        if(!$user){
            return $this->errorResponse('user not found', 401);
        }
        if(!Hash::check($request->password , $user->password)){
            return $this->errorResponse('password is incorrect', 401);
        }

        $token = $user->createToken('myApp')->accessToken;

        return $this->successResponse([
            'user' => $user,
            'token' => $token
        ], 200);
    }




    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse('logged out' , 200);
    }
}
