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

        
        return [
            'user' => [
                'name' => $this->name,
                'email' => $this->email,
            ],
            'profile_id' => $this->profile_id
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
