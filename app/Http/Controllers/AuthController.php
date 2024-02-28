<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Jwt\GenerateToken;
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
    /*
    public function __construct()
    {
        $this->middleware('auth:auth_token', ['except' => ['login', 'registera']]);//login, register methods won't go through the api guard
    }
    */
    /*
    public function test (Request $request){
        return response()->json([
            "status" => "success",
            "message" => "Ga registrado",
        ]);
    }
    */
    

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

            $data = [
                "id" => $user->id,
                "email" => $user->email,
                "password" =>$request->email,
                "profile_id_selected" => null
            ];

            $token = (new GenerateToken)->getJWTToken($data);

            $registerAuthResource = new RegisterAuthResource($user);
            $registerAuthResource->additional([ 'profile_id_selected' => null, 'status' => true ,'token' => $token]);
            return  $registerAuthResource;

            /*
            return response()->json([
                "status" => "success",
                "message" => "Usuario registrado",
                "token" => $token
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


       
    public function login(LoginAuthRequest $request){
        $credentials = $request->only('email', 'password');

        try {
            //$user = User::where('email', $credentials['email'])->with('profiles')->first();
            $user = User::where('email', $credentials['email'])
                            /*->with(['profiles' => function ($query) {
                                $query->where('status', 1)
                                ->orderBy('id', 'desc'); // Ordenar los perfiles por el campo 'id' de forma descendente
                            }])*/
                            ->first();
            if(!$user){
                return response()->json([
                    "status" => "error",
                    "message" => "Correo electrónico desconocido, ¿Está bien escrito?"
                ], 401);
            }
            if (!Hash::check($credentials['password'], $user->password)){
                return response()->json([
                    "status" => "error",
                    "message" => "Ocurrió un error al iniciar sesión. Es necesario que verifiques tu correo y contraseña para intentar de nuevo. En ¿Olvidaste la contraseña?, podrás restablecerla (código de error 92)."
                ], 401);
            }
            if ($user->status !== 1){
                return response()->json([
                    "status" => "error",
                    "message" => "El usuario ya no se encuentra activo"
                ], 401);
            }

            $user->profile_selected = null;

            $token = (new GenerateToken)->getJWTToken([
                "user" => $user,
                "profile_id" => null
            ]);
            
            $loginAuthResource = new LoginAuthResource($user);
            $loginAuthResource->additional([ 'status' => true ,'token' => $token]);
            
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
