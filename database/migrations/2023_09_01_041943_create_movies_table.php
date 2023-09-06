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
            $table->unsignedBigInteger("genre_id");
            $table->unsignedBigInteger("age_category_id");
            $table->boolean("status");
            $table->string("name");
            $table->string("description");
            $table->text("summary");
            $table->time('duracion');
            $table->date('release_date');
            $table->timestamps();
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('age_category_id')->references('id')->on('age_categories');
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
