<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            //"status" => ($this->status) ? true : false,
            "image" => $this->profile_image->route
        ];


        /*
                    $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("profile_image_id");
            $table->string("name");
            $table->boolean("status");
            $table->timestamps();

        */

    }
}
