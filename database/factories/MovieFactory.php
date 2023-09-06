<?php

namespace Database\Factories;

use App\Models\AgeCategory;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genre = Genre::inRandomOrder()->first();
        $ageCategory = AgeCategory::inRandomOrder()->first();


        return [
            "genre_id" => $genre->id,
            "age_category_id" => $ageCategory->id,
             "status" => fake()->boolean(),
            "name" =>fake()->name(),
            "description" => fake()->text(),
            "summary" => fake()->text(),
            "duracion" => fake()->time(),
            "release_date" => fake()->date(),

        ];

        /*
 $table->id();
            $table->unsignedBigInteger("genre_id");
            $table->unsignedBigInteger("age_category_id");
            $table->boolean("status");
            $table->string("name");
            $table->string("description");
            $table->text("summary");
            $table->time('duracion');
            $table->time('release_date');

            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('age_category_id')->references('id')->on('age_categories');

        */
    }
}
