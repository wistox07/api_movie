<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ImageFactory extends Factory
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
            "route" => $fileName.".jpg"
        ];


            /*
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->name();
            $table->string('route'); // Ruta o URL de la imagen
            $table->timestamps();
            $table->bool("status");
        });

    */
    }
}
