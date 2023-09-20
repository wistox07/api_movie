<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginAuthResource;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    public function register(RegisterAuthRequest $request)
    {
        // Validation logic here
        try {

            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                "status" =>1
            ]);
            $user->save();
            
            return response()->json([
                "status" => "success",
                "message" => "Usuario registrado"
            ]);
            
            //Registrar perfil 
            //Registrar asociar imagen
            //enviar correo


        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                "message" => $ex->getMessage()
            ], 500);
        }

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

        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                "message" => $ex->getMessage()
            ], 500);
        }
        
    }

    
        
    

    public function logout(Request $request)
    {
        try{
            JWTAuth::invalidate(JWTAuth::getToken());
        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                "message" => $ex->getMessage()
            ], 500);
        }

        return response()->json([
            "status" => "success",
            "message" => "Token Eliminado"
        ]);
    }


}
