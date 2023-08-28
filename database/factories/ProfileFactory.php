<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\ProfileImage;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $profile = ProfileImage::inRandomOrder()->first();
        return [
            "user_id" => $user->id,
            "profile_image_id" => $profile->id,
            "name" => fake()->name(),
            "status" => fake()->boolean()
        ];
    }

}
