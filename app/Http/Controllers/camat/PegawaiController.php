<?php

namespace App\Http\Controllers\camat;

use App\Http\Controllers\Controller;
use App\Libraries\Pdf;
use App\Libraries\Template;
use App\Models\Gapok;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'camat');
    }

    public function det($id)
    {
        $id_pegawai = my_decrypt($id);

        // pegawai
        $pegawai = Pegawai::with(['toUsers', 'toAgama', 'toJabatan', 'toPangkat', 'toPendidikan'])->find($id_pegawai);
        // gaji pokok
        $mkg   = count_year($pegawai->tmt);
        $gapok = Gapok::whereIdPangkat($pegawai->id_pangkat)->where('dari', '<=', $mkg)->where('sampai', '>=', $mkg)->first();

        $data = [
            'pegawai' => $pegawai,
            'mkg'     => $mkg . ' Tahun',
            'gapok'   => $gapok,
        ];

        return Template::load($this->session['roles'], 'Detail Pegawai', 'pegawai', 'det', $data);
    }

    public function print($id)
    {
        $id_pegawai = my_decrypt($id);

        // pegawai
        $pegawai = Pegawai::with(['toUsers', 'toAgama', 'toJabatan', 'toPangkat', 'toPendidikan'])->find($id_pegawai);
        // pangkat & gaji pokok old
        $pangkat_old     = DB::select("SELECT pp.id_pegawai_pangkat, pp.id_pangkat, pp.tmt, p.nama FROM pegawai_pangkat AS pp LEFT JOIN pangkat AS p ON p.id_pangkat = pp.id_pangkat WHERE pp.id_pegawai = '$id_pegawai' ORDER BY pp.created_at DESC LIMIT 1,1");
        $pangkat_old_row = $pangkat_old[0];
        $mkg_old         = count_year($pangkat_old_row->tmt);
        $gapok_old       = Gapok::whereIdPangkat($pangkat_old_row->id_pangkat)->where('dari', '<=', $mkg_old)->where('sampai', '>=', $mkg_old)->first();

        $pangkat_new     = DB::select("SELECT pp.id_pegawai_pangkat, pp.id_pangkat, pp.tmt, p.nama FROM pegawai_pangkat AS pp LEFT JOIN pangkat AS p ON p.id_pangkat = pp.id_pangkat WHERE pp.id_pegawai = '$id_pegawai' ORDER BY pp.created_at DESC LIMIT 1");
        $pangkat_new_row = $pangkat_new[0];
        $mkg_new         = count_year($pangkat_new_row->tmt);
        $gapok_new       = Gapok::whereIdPangkat($pangkat_new_row->id_pangkat)->where('dari', '<=', $mkg_new)->where('sampai', '>=', $mkg_new)->first();

        $data = [
            'title'       => 'Surat Kenaikan Pangkat Pegawai Negeri Sipil',
            'pegawai'     => $pegawai,
            'pangkat_old' => $pangkat_old_row,
            'mkg_old'     => $mkg_old,
            'gapok_old'   => $gapok_old,
            'pangkat_new' => $pangkat_new_row,
            'gapok_new'   => $gapok_new,
        ];

        Pdf::printPdf('Kenaikan Gaji', 'camat.pegawai.print', '', '', $data);
    }
}
