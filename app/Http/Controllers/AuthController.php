<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Resources\LoginAuthResource;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Exception;

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
            $user = User::where('email', $credentials['email'])->first();
            if (!$user || !Hash::check($credentials['password'], $user->password)){
                return response()->json([
                    "status" => "error",
                    "message" => "Credenciales incorrectas"
                ], 401);
            }
            if ($user->status !== 1){
                return response()->json([
                    "status" => "error",
                    "message" => "El usuario no se encuentra activo"
                ], 401);
            }
           

            $token = JWTAuth::fromUser($user);
            $loginAuthResource = new LoginAuthResource($user);
            $loginAuthResource->additional(['status' => true ,'token' => $token]);
            return  $loginAuthResource;

        } catch (Exception $e) {
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
