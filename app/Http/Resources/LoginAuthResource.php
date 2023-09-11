<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
                    /*'email_verified_at' => Carbon::parse($this->email_verified_at)->toDateTimeString(),
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            "profile_id" => $this->profile_id*/

        /*
        return [
            "user" => [
                "id" => $this->id,
                "name" => $this->name,
                "email" => $this->email,
            ]


        ];
        */
        

        return [
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
            ],
            "profiles" => $this->profiles
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
