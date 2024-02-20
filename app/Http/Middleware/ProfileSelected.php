<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\Response;

class ProfileSelected
{
    protected mixed $key;

    public function __construct()
    {
        $this->key = config('app.sal');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            //dd($request->header('token'));
           $deserializeToken = JWT::decode($request->header('token'), new Key($this->key, 'HS256'));
           if(!$deserializeToken->data->profile_id){
            return response()->json([
                'status' => "error",
                'message' => 'EL usuario debe escoger un perfil'
            ], 401); 
           }

        } catch (\Exception $e) {
            return response()->json([
                'status' => "error",
                'message' => $e->getMessage()
            ], 401);
        }
        return $next($request);
    }
}
