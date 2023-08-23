<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ImageProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageId = Image::inRandomOrder()->first();
        $profileId = Profile::inRandomOrder()->first();

        return [
            "image_id" => $imageId,
            "profile_id" => $profileId,
            "status" => true

        ];
    }
}
