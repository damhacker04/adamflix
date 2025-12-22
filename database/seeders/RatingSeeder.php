<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Movie;
use App\Models\User;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('ratings')->truncate();

        $movies = Movie::all();
        $users = User::all();

        $ratings = [];
        
        foreach ($movies as $movie) {
            foreach ($users as $user) {
                $rating = fake()->randomFloat(1, 0, 10); // Generates a rating between 1.0 and 5.0
                $ratings[] = [
                    'user_id' => $user->id,
                    'movie_id' => $movie->id,
                    'rating' => $rating,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('ratings')->insert($ratings);

        Schema::enableForeignKeyConstraints();
    }
}
