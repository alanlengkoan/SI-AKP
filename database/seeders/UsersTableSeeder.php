<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert users
        $user = new User();
        $user->id_users = '1';
        $user->nama     = 'Administrator';
        $user->email    = 'admin@gmail.com';
        $user->roles    = 'admin';
        $user->active   = 'y';
        $user->username = 'admin';
        $user->password = '$2y$10$kYtHSUrj9tFz17XikkGqcu232LxX5ueKl6oxnKcbjr9ch9ZO48YgG';
        $user->save();
    }
}
