<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request){
        
        if(Auth::attempt($request->only('email','password'))){
           
            $token=$request->user()->createToken('userToken')->plainTextToken;
            return response()->json("user logged in successfully + $token");
        }
         return response()->json(['message'=>"wrong email or password"],Response::HTTP_NON_AUTHORITATIVE_INFORMATION);

    }
    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'logged out']);
        
    }
    public function sendEmailVerification(Request $request){
        
        $request->user()->sendEmailVerification();
        return response()->json(['Email has sent to you']);
    }
    public function verify(EmailVerificationRequest $request){

        $request->fulfill();
        return response()->json('verified');
    }
}
