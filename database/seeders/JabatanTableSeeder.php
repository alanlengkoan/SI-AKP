<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = [
            [
                'nama'     => 'Kepala Desa',
                'by_users' => '1'
            ],
            [
                'nama'     => 'Sekretaris Desa',
                'by_users' => '1'
            ],
            [
                'nama'     => 'Bendahara Desa',
                'by_users' => '1'
            ]
        ];
        foreach ($jabatan as $key => $value) {
            DB::table('jabatan')->insert($value);
        }
    }
}
