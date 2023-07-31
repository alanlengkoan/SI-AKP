<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PangkatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pangkat = [
            [
                'nama'     => 'Golongan Ia (Juru Muda)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan Ib (Juru Muda Tingkat I)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan Ic (Juru)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan Ia (Juru Tingkat I)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IIa (Pengatur Muda)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IIb (Pengatur Muda Tingkat I)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IIc (Pengatur)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IId (Pengatur Tingkat I)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IIIa (Penata Muda)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IIIb (Penata Muda Tingkat I)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IIIc (Penata)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IIId (Penata Tingkat I)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IVa (Pembina)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IVb (Pembina Tingkat I)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IVc (Pembina Muda)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IVd (Pembina Madya)',
                'by_users' => 1
            ],
            [
                'nama'     => 'Golongan IVe (Pembina Utama)',
                'by_users' => 1
            ],
        ];
        foreach ($pangkat as $row) {
            DB::table('pangkat')->insert($row);
        }
    }
}
