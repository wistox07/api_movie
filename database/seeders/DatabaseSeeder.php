<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profile;
use App\Models\ProfileImage;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         ProfileImage::factory(20)->create();
         Profile::factory(10)->create();
         Actor::factory(10)->create();
         Director::factory(10)->create();
         //GENEROS
         DB::table('genres')->insert([
            'name' => 'ciencia ficción',
            'status' => true,
        ]);
        
        DB::table('genres')->insert([
            'name' => 'acción y aventura',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'comédia',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'crimen',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'drama',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'terror',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'suspenso',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'música',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'romance',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'documental',
            'status' => true,
        ]);

        DB::table('genres')->insert([
            'name' => 'biografía',
            'status' => true,
        ]);

        //TIPO DE IMAGENES DE PELICULAS
        /*
            $table->id();
            $table->string("name");
            $table->string("description")->nullable();
            $table->boolean("status");
            $table->timestamps();
        */
        DB::table('type_movie_images')->insert([
            'name' => 'portada',
            'status' => true,
        ]);
        DB::table('type_movie_images')->insert([
            'name' => 'fondo',
            'status' => true,
        ]);

        //categoria de edad
        DB::table('age_categories')->insert([
            'name' => 'mayores de 12 años',
            'min_edge' => 12,
            'status' => true
        ]);


        DB::table('age_categories')->insert([
            'name' => 'mayores de 15 años',
            'min_edge' => 15,
            'status' => true
        ]);
        // MAIN
    }
}
