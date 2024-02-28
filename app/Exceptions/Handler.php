<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Throwable;




class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function invalidJson($request, ValidationException $exception)
    {

        return response()->json([
            "status" => "error",
            'message' => __('Los datos proporcionados no son válidos'),
            'errors' => $errors = $exception->validator->errors()->all()
        ], $exception->status);

        
    }

    public function render($request , Throwable $exception){
        if($exception instanceof ModelNotFoundException){
            //$modelName = class_basename($exception->getModel());
            return  response()->json([
                "status" => "error",
                "message" => "No se encontraron datos"
            ], 400);
        }
        return parent::render($request, $exception);
    }
/*
    protected function unauthenticated($request, AuthenticationException $exception) 
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Token Inválido'
        ], 401);
    }
*/
}
