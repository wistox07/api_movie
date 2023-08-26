<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Profile;
use App\Models\Image;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         Image::factory(50)->create();
         Profile::factory(20)->create();

        for ($i=0; $i <= 20; $i++) { 
            $image = Image::inRandomOrder()->first();
            $profile= Profile::inRandomOrder()->first();
            
            DB::table('image_profile')->insert([
                'image_id' =>  $image->id,
                'profile_id' => $profile->id,
                'created_at'  => now(),
                'status' => true
            ]);
        }
    }
}
