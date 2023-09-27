<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\ChooseProfileRequest;
use App\Http\Resources\LoginAuthResource;
use App\Models\User;
use Exception;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function chooseProfile(ChooseProfileRequest $request){
        try {
            $profile = Profile::find($request->profile_image_id);
            $user = $profile->user;
            dd($profile,$user);
            

            /*
            $user->save();
            $token = JWTAuth::fromUser($user);
            $registerAuthResource = new RegisterAuthResource($user);
            $registerAuthResource->additional(['status' => "success" ,'token' => $token]);
            return  $registerAuthResource;
            */
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

    public function me(){
        try{
            $userToken = JWTAuth::parseToken()->authenticate();
            $user = User::find($userToken->id);
            $loginAuthResource = new LoginAuthResource($user);
            $loginAuthResource->additional(['status' => true]);
            return  $loginAuthResource;

        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                "message" => $ex->getMessage()
            ], 500);
        }

    }

     public function index()
    {
        return Profile::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        try {

            $user = JWTAuth::parseToken()->authenticate();
            $profile = new Profile([
                'user_id' => $user->id,
                "profile_image_id" => $request->profile_image_id,
                'name' => $request->name,
                "status" =>1
            ]);
            $profile->save();
            
            return response()->json([
                "status" => "success",
                "message" => "Perfil registrado"
            ]);

        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
