<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agama = [
            [
                'nama'     => 'Islam',
                'by_users' => 1
            ],
            [
                'nama'     => 'Kristen',
                'by_users' => 1
            ],
            [
                'nama'     => 'Katolik',
                'by_users' => 1
            ],
            [
                'nama'     => 'Hindu',
                'by_users' => 1
            ],
            [
                'nama'     => 'Budha',
                'by_users' => 1
            ],
            [
                'nama'     => 'Konghucu',
                'by_users' => 1
            ]
        ];
        foreach ($agama as $row) {
            DB::table('agama')->insert($row);
        }
    }
}
