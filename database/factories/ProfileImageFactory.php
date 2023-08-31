<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileImage>
 */
class ProfileImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $formatTexto = str_replace(' ', '_', $name);
        $fileName = strtolower($formatTexto);
        return [
            'name' => $name,
            "route" => $fileName.".jpg",
            "status" => fake()->boolean()

        ];
    }
}
