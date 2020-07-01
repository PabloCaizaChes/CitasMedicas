<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use JwtAuth;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
    $credentials =$request->only('email','password');
 

    
    if(Auth::guard('api')->attempt($credentials)) {
    $user = Auth::guard('api')->user();
    
    $jwt = JwtAuth::generateToken($user);
    
    $successfull = true;
    
    // Return successfull sign in response with the generated jwt.
    		return compact('error', 'user','jwt');

		} else {
 

    // Return response for failed attempt...
			$error = false ; 
			$message = 'Invalid credentials';
			return compact('error','message');


		}
     
    }

     public function logout()
     {
    	Auth::guard('api')->logout();
    	$succes=true;
    	return compact('succes');
    	
    }


}
