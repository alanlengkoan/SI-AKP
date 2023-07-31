<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class, // untuk default user
            AgamaTableSeeder::class, // untuk default agama 
            JabatanTableSeeder::class, // untuk default jabatan
            PangkatTableSeeder::class, // untuk default pangkat
            PendidikanTableSeeder::class, // untuk default pendidikan
        ]);
    }
}
