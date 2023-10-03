<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginAuthResource;
use App\Http\Resources\ProfileResource;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Resources\RegisterAuthResource;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use Exception;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);//login, register methods won't go through the api guard
    }

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
            $registerAuthResource = new RegisterAuthResource($user);
            $registerAuthResource->additional(['status' => "success" ,'token' => $token]);
            return  $registerAuthResource;

            /*
            return response()->json([
                "status" => "success",
                "message" => "Usuario registrado"
            ]);
            */
            
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


           
            $loginAuthResource = ProfileResource::collection($user->profiles->where('status', 1)->sortBy('id', false));
            $loginAuthResource->additional(['status' => true ,'token' => $token]);
            return  $loginAuthResource;
            //return ProfileResource::collection(Profile::where('status', 1)->get());
            
            //
            //$loginAuthResource = new LoginAuthResource($user);
            //$loginAuthResource->additional(['status' => true ,'token' => $token]);
            //return  $loginAuthResource;

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
    /*
    public function deserialize(){

        try {
            return response()->json($user);

        } catch (Exception $ex) {
            response()->json([
                "status" => "error",
                "message" => $ex->getMessage()
            ]);
            // Manejar el caso en que el token sea inválido o expire
            
        }
    }
    */


}
