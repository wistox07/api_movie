<?php

namespace App\Http\Jwt;

use Carbon\Carbon;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;


class GenerateToken
{
	protected mixed $key;
	protected mixed $code;

	public function __construct()
	{
        $this->key = config('app.sal');
	}

	public function generateVerificationCode($params): JsonResponse|string
	{
		try {
			$token = array(
				'iat' => Carbon::now(), // Tiempo que inició el token
				'exp' => Carbon::now()->addDays(30)->timestamp, // Tiempo que expirara el token es 2 días
				'data' => $params
				
			);
			return JWT::encode($token, $this->key, 'HS256');
		} catch (Exception $e) {
			return response()->json(['Error' => $e]);
		}
	}

	public function verifyToken($jwt): Exception|\stdClass
	{
		try {
			return JWT::decode($jwt, new Key($this->key, 'HS256'));
		} catch (Exception $e) {
			return $e;
		}
	}

	public function getJWTToken($params): string
	{
		try {
			$time = time();
			return JWT::encode([
				'iat' => $time,
				'nbf' => $time,
				'exp' => Carbon::now()->addDays(7)->timestamp,
				'data' => $params
			], $this->key, 'HS256');
		} catch (Exception $e) {
			return response()->json(['Error' => $e]);
		}
	}
}
