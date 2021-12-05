<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::connection('conn_proyek')->table('genre')->insert([
            [ "name"     => "Action" ],
            [ "name"     => "Adventure" ],
            [ "name"     => "Comedy" ],
            [ "name"     => "Crime" ],
            [ "name"     => "Drama" ],
            [ "name"     => "Fantasy" ],
            [ "name"     => "Gore" ],
            [ "name"     => "Historical" ],
            [ "name"     => "Horror" ],
            [ "name"     => "Mystery" ],
            [ "name"     => "Psychological" ],
            [ "name"     => "Romance" ],
            [ "name"     => "Sci-Fi" ],
            [ "name"     => "Shounen" ],
            [ "name"     => "Shoujo" ],
            [ "name"     => "Slice of Life" ],
            [ "name"     => "Sports" ],
            [ "name"     => "Thriller" ],
        ]);
    }
}
