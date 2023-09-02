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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("genre_movie_id");
            $table->unsignedBigInteger("age_rating_movie_id");
            $table->unsignedBigInteger("director_movie_id");

            $table->string("name");
            $table->string("description");
            $table->string("summary");
            $table->time('duracion');
            $table->time('release_date');





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
