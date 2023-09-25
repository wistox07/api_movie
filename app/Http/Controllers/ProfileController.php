<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Tymon\JWTAuth\Facades\JWTAuth;
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

    public function me(){
        
    }

     public function index()
    {
        return Profile::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
