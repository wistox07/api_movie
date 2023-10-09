<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        //$movie = Movie::with('genre')->get();
        $movies = Movie::with('genre')
                    ->with('ageCategory')
                    ->with('actors')
                    ->with('directors')
                    ->with('movieImages')
                    ->with('movieImages.typeMovieImage')
                    ->get();
        /*
    public function actors(){
        return $this->belongsToMany(Actor::class);
    }

    public function directors(){
        return $this->belongsToMany(Director::class);
    }
        */
        return MovieResource::collection($movies);

        /*->with(['genre' => function ($query) {
            $query->where('status', 1)
            ->orderBy('id', 'desc'); // Ordenar los perfiles por el campo 'id' de forma descendente
        }])
        ->first();
        */
        //$movieResource = new MovieResource($movie);
       // $movieResource->additional([ 'profile_id_selected' => null, 'status' => true ,'token' => $token]);
       // return  $movieResource;


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
