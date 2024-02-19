<?php

namespace App\Http\Controllers;

use App\Http\Jwt\GenerateToken;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\ChooseProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProfilesForToken(Request $request){
        $requestToken = request()->header('token');
        $deserializeToken = (new GenerateToken)->verifyToken($requestToken);
        $userId = $deserializeToken->data->user->id;
        
        $profiles =  Profile::where('user_id', $userId)->get();
        return ProfileResource::collection($profiles)->additional(['status' => true ]);

    }

    public function chooseProfile(Request $request){
        /*try {
            //
            $profile_id =  (int) $request->input("profile_id");
            $requestToken = request()->header('token');
            $deserializeToken = (new GenerateToken)->verifyToken($requestToken);
            $userId = $deserializeToken->data->user->id;

            $user = User::where('id', $userId)
            ->with(['profiles' => function ($query) {
                $query->where('status', 1)
                ->orderBy('id', 'desc'); // Ordenar los perfiles por el campo 'id' de forma descendente
            }])
            ->first();


            if ($user->status !== 1){
                return response()->json([
                    "status" => "error",
                    "message" => "El usuario no se encuentra activo"
                ], 401);
            }

            $profile = Profile::where('id', $profile_id)->first();
            if ($profile->status !== 1){
                return response()->json([
                    "status" => "error",
                    "message" => "El Perfil no se encuentra activo"
                ], 401);
            }

            $data = [
                "user" => $user,
                "profile_id_selected" =>  $profile_id
            ];
            
            $token = (new GenerateToken)->getJWTToken($data);
            $loginAuthResource = new LoginAuthResource($user);
            $loginAuthResource->additional([ 'profile_id_selected' => $profile_id, 'status' => true ,'token' => $token]);
            return  $loginAuthResource;

        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                "message" => $ex->getMessage(),
                'trace' => $ex->getTrace()
            ], 500);
        }
        */
    }

    public function getProfiles(Request $request){
        try {
                $requestToken = request()->header('token');
                $deserializeToken = (new GenerateToken)->verifyToken($requestToken);

                $userId = $deserializeToken->data->id;
                $email = $deserializeToken->data->email;
                $password =  $deserializeToken->data->password;

                $user = User::where('email', $email)
                ->with(['profiles' => function ($query) {
                    $query->where('status', 1)
                    ->orderBy('id', 'desc'); // Ordenar los perfiles por el campo 'id' de forma descendente
                }])
                ->first();
                
                if(!$user){
                    return response()->json([
                        "status" => "error",
                        "message" => "No existe un usuario registrado con ese email"
                    ], 401);
                }

                if (!Hash::check($password, $user->password)){
                    return response()->json([
                        "status" => "error",
                        "message" => "Las credenciales fueron actualizadas, por favor ingrese nuevamente"
                    ], 401);
                }

                if ($user->status !== 1){
                    return response()->json([
                        "status" => "error",
                        "message" => "El usuario ya no se encuentra activo"
                    ], 401);
                }

                /*
                $user = User::where('id', $userId)
                ->with(['profiles' => function ($query) {
                    $query->where('status', 1)
                    ->orderBy('id', 'desc'); // Ordenar los perfiles por el campo 'id' de forma descendente
                }])->first();
                */
/*
                if ($user->status !== 1){
                    return response()->json([
                        "status" => "error",
                        "message" => "El usuario no se encuentra activo"
                    ], 401);
                }*/

                /*
                $profile = Profile::where('id', $profile_id)->first();
                if ($profile->status !== 1){
                    return response()->json([
                        "status" => "error",
                        "message" => "El Perfil no se encuentra activo"
                    ], 401);
                }
                */
            /*
            $data = [
                "user" => $user,
                "profile_id_selected" =>  $profile_id
            ];
            */
            
            
            //$token = (new GenerateToken)->getJWTToken($data);
            $loginAuthResource = new LoginAuthResource($user);
            $loginAuthResource->additional(['status' => true ]);
            return  $loginAuthResource;

        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                "message" => $ex->getMessage(),
                'trace' => $ex->getTrace()
            ], 500);
        }
    }

    public function me(){
        try{
            //$user = User::find($userToken->id);
            //$loginAuthResource = new LoginAuthResource($user);
            //$loginAuthResource->additional(['status' => true]);
            //return  $loginAuthResource;

        }catch(Exception $ex){
            return response()->json([
                'status' => 'error',
                "message" => $ex->getMessage()
            ], 500);
        }

    }

     public function index()
    {
        $profile = Profile::all();

        return response()->json([
            $profile
        ], 500);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        try {

            $profile = new Profile([
               // 'user_id' => $user->id,
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
