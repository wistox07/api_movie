<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProfileResource;

class LoginAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        //dd($this);
        //dd($this);
        
        return [
            'user' => [
                'name' => $this->name,
                'email' => $this->email,
            ],
            'profile_id' => null
            //"profiles" => ProfileResource::collection($this->profiles)
        ];


    }

    /*
    public function with($request){
        return [
            "status" => true
        ];
    }
    */
}
