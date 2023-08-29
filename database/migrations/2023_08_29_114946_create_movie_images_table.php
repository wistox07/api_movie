<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movie_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("type_movie_image_id");
            $table->unsignedBigInteger("movie_id");
            $table->string("name");
            $table->string('route'); // Ruta o URL de la imagen
            $table->boolean("status");
            $table->timestamps();
            $table->foreign('type_movie_image_id')->references('id')->on('type_movie_images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_images');
    }
};
