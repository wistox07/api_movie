<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "description" => fake()->date(),
            "nationality" => fake()->nationality(),
            "status" => fake()->boolean()
            
        ];


        /*
            $table->id();
            $table->string("name");
            $table->string("description")->nullable();
            $table->boolean("status");
            $table->timestamps();
        */
    }
}
