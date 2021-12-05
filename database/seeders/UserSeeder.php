<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::factory()->count(10)->make()->each(function ($user){
            $user->save();
            if($user->id == 1){
                $user->username = 'admeen';
                $user->password = Hash::make('wasd');
                $user->role = 'admin';
                $user->save();
            }
        });
    }
}
