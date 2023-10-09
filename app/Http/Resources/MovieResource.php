<?php

namespace App\Http\Resources;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PersonMovieResource;
use App\Http\Resources\MovieImagesResource;



class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'summary' => $this->summary,
                'duration' => $this->duracion,
                'release_date' => $this->release_date,
                'genre_id' => $this->genre->id,
                'genre' => $this->genre->name,
                'category_id' => $this->ageCategory->id,
                'category' => '+ ' . $this->ageCategory->min_edge,
                'actors' =>  PersonMovieResource::collection($this->actors),
                'directors' =>  PersonMovieResource::collection($this->directors),
                'images' =>  MovieImagesResource::collection($this->movieImages)

        ];

    }
}
