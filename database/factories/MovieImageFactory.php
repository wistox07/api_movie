<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeMovieImage;
use App\Models\Movie;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typeMovieImage = TypeMovieImage::inRandomOrder()->first();
        $movie = Movie::inRandomOrder()->first();

        $name = fake()->name();
        $formatTexto = str_replace(' ', '_', $name);
        $fileName = strtolower($formatTexto);
        return [
            "type_movie_image_id" => $typeMovieImage->id,
            "movie_id" => $movie->id,
            'name' => $name,
            "route" => $fileName.".jpg",
            "status" => fake()->boolean()

        ];

        /*
  $table->id();
            $table->unsignedBigInteger("type_movie_image_id");
            $table->unsignedBigInteger("movie_id");
            $table->string("name");
            $table->string('route'); // Ruta o URL de la imagen
            $table->boolean("status");
            $table->timestamps();
            $table->foreign('type_movie_image_id')->references('id')->on('type_movie_images');

        */
    }
}
