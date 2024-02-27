<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
class AuthenticateToken
{
    protected mixed $key;

    public function __construct()
    {
        $this->key = config('app.sal');
    }

    public function handle(Request $request, Closure $next)
    {
        /*
        try {
            $deserializeToken = JWT::decode($request->header('token'), new Key($this->key, 'HS256'));
            //dd($deserializeToken);
            if(!$deserializeToken->data->profile_id_selected){
                throw new Exception('El token proporcionado no cuenta con perfil');
            }
            

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getCode(),
                //'message' => $e->getMessage()
                'message' => 'Token no valido'
            ], 401);
        }
        return $next($request);
 
        */

        try {
            $token = $request->header('token');
            if (!$token) {
                throw new Exception("Token missing"); // Lanza una excepción si el token está ausente
            }
            
            JWT::decode($request->header('token'), new Key($this->key, 'HS256'));
        } catch (\Exception $e) {
            return response()->json([
                'status' => "error",
                'message' => $e->getMessage()
            ], 401);
        }
        return $next($request);
    }
}
