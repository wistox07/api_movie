<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Actor;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ActorMovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actor = Actor::inRandomOrder()->first();
        $movie = Movie::inRandomOrder()->first();

        return [
            "actor_id" => $actor->id,
            "movie_id" => $movie->id,
            "status" => fake()->boolean()
        ];
    }
}
