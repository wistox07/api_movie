<?php

namespace App\Http\Middleware;

use Closure;
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
        try {
            JWT::decode($request->header('token'), new Key($this->key, 'HS256'));
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getCode(),
                //'message' => $e->getMessage()
                'message' => 'Token no valido'
            ], 401);
        }
        return $next($request);
    }
}
