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
        Schema::create('image_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("image_id");
            $table->unsignedBigInteger("profile_id");
            $table->boolean("status");
            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_profile');
    }
};
