<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Director;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DirectorMovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $director = Director::inRandomOrder()->first();
        $movie = Movie::inRandomOrder()->first();

        return [
            "director_id" => $director->id,
            "movie_id" => $movie->id,
            "status" => fake()->boolean()
        ];
    }
}
