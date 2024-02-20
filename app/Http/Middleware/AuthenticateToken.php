<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

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
            JWT::decode($request->header('token'), new Key($this->key, 'HS256'));
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getCode(),
                'message' => 'Token no valido'
            ], 401);
        }
        return $next($request);
    }
}
