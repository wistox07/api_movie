<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class Token
{
    protected mixed $key;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function __construct()
    {
        $this->key = config('app.sal');
    }

    public function handle(Request $request, Closure $next)
    {
        try {
            JWT::decode($request->header('token'), new Key($this->key, 'HS256'));
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getCode(),
                //'message' => $e->getMessage()
                'message' => 'Token no valido'
            ], 401);
        }
        return $next($request);
    }
}
