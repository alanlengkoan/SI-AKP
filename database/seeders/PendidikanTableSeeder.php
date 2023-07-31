<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pendidikan = [
            [
                'nama'     => "Administrasi Bisnis (S.A.B.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Administrasi Publik (S.A.P.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Agama (S.Ag.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Agroteknologi (S.Agr)[2]",
                'by_users' => 1
            ],
            [
                'nama'     => "Akuntansi (S.Ak.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Antropologi (S.Ant.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Arsitektur (S.Ars.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Desain (S.Ds./S.Des.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ekonomi (S.E.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ekonomi Asuransi (S.E.As.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ekonomi Islam (S.E.I.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ekonomi Syari'ah (S.E.Sy.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Farmasi (S.Farm.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Filsafat (S.Fil.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Filsafat Hindu (S.Fil.H.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Filsafat Islam (S.Fil.I.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Fisioterapi (S.Ft.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Hubungan Internasional (S.Hub.Int.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Hukum (S.H.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Hukum Islam (S.H.I.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Hukum Hindu (S.H.H.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Humaniora (S.Hum.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Administrasi (S.I.A.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Gizi (S.Gz.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Kelautan (S.Kel. atau S. IK)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Keluarga dan Konsumen (S.I.K.K.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Kepolisian (S.I.K.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Komunikasi (S.I.Kom.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Pemerintahan (S.IP.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Perpustakaan (S.I.Ptk.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Perpustakaan dan Informasi (S.IIP.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Politik (S.I.P.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Sosial (S.Sos.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Intelijen (S.In.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Kebidanan (S.Keb.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Kedokteran (S.Ked.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Kedokteran Gigi (S.KG.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Kedokteran Hewan (S.K.H.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Kehutanan (S.Hut.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Keperawatan (S.Kep.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Kesehatan Lingkungan (S.K.L.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Kesehatan Masyarakat (S.K.M.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Komputer (S.Kom.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Komunikasi Islam (S.Kom.I.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Komunikasi dan Pengembangan Masyarakat (S.K.P.M.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Linguistik (S.Li.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Manajemen (S.M.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Manajemen Bisnis (S.Mb.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Pariwisata (S.Par.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Pendidikan (S.Pd.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Pendidikan Buddha (S.Pd.B)",
                'by_users' => 1
            ],
            [
                'nama'     => "Pendidikan Hindu (S.Pd.H.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Pendidikan Islam (S.Pd.I.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Pendidikan Sains (S.Pd.Si.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Pendidikan Sekolah Dasar (S.Pd.SD.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Perikanan (S.Pi.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Perpajakan (S.Pn.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Ilmu Perpustakaan (S.Ptk.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Pertahanan (S.Han.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Peternakan (S.Pt.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Psikologi (S.Psi.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Perencanaan Wilayah dan Kota (S.PWK.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sains (S.Si.)[3]",
                'by_users' => 1
            ],
            [
                'nama'     => "Sains Theologi (S.Si.Th.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sains Terapan (S.ST.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sains Terapan Pemerintahan (S.STP.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sastra (S.S.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Seni (S.Sn.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sistem Informasi (S.SI. atau S.Kom.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sosial (S.Sos.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sosial Hindu (S.Sos.H.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sosial Islam (S.Sos.I.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Syari'ah (S.Sy.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Statistika (S.Stat.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Teknik (S.T.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Teknologi Informasi (S.TI.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Teknologi Pertanian (S.T.P.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Teologi (S.Th.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Ilmu Pemerintahan (S.Tr.IP.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Kepolisian (S.Tr.K.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Pekerjaan Sosial (S.Tr.Sos.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Perikanan (S.Tr.Pi.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Teknik (S.Tr.T.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Pertahanan (S.Tr.Han.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Kebidanan (S.Tr.Keb.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Komputer (S.Tr.Kom.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Terapan Bisnis (S.Tr.Bns.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Bisnis Digital (S.Bis.Dig.)",
                'by_users' => 1
            ],
            [
                'nama'     => "Sains Terapan Perikanan (S.St.Pi)",
                'by_users' => 1
            ],
        ];
        foreach ($pendidikan as $row) {
            DB::table('pendidikan')->insert($row);
        }
    }
}
