<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Resources\LoginAuthResource;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validation logic here
        
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $user->save();
        
        return response()->json(['message' => 'User registered successfully']);
    }


       
    public function login(LoginAuthRequest $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    "status" => "error",
                    "message" => "Credenciales incorrectas"
                ], 401);
            }

            $loginAuthResource = new LoginAuthResource(JWTAuth::user());
            $loginAuthResource->additional(['status' => true ,'token' => $token]);
            return  $loginAuthResource;

        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                "message" => $e->getMessage()
            ], 500);
        }
    }

    
        
    

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        
        return response()->json(['message' => 'User logged out successfully']);
    }
}
