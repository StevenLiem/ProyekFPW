<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::connection('conn_proyek')->table('author')->insert([
            [ "name"     => "Ishida Sui" ],
            [ "name"     => "Saisou" ],
            [ "name"     => "Too" ],
            [ "name"     => "Lazy" ],
            [ "name"     => "To Do This" ]
        ]);
    }
}
