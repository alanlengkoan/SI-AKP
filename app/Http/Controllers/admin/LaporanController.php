<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\AmpraGaji;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    // untuk deposit
    public function skpp()
    {
        $data = [
            'bulan' => config('constants.bulan'),
            'tahun' => year(2020, date('Y')),
        ];

        return Template::load($this->session['roles'], 'Laporan SKPP', 'laporan', 'skpp/view', $data);
    }

    public function get_data_skpp_dt(Request $request)
    {
        $query = AmpraGaji::query();
        $query->with(['toPegawai.toJabatan', 'toPegawai.toPangkat', 'toPegawai.toJenisSkpp', 'toPegawai.toAsalSuratKeputusan']);
        $query->orderBy('ampra_gaji.id_pegawai', 'desc');
        if ($request->bulan) {
            $query->whereMonth('ampra_gaji.tgl_surat', '=', $request->bulan);
        }
        if ($request->tahun) {
            $query->whereYear('ampra_gaji.tgl_surat', '=', $request->tahun);
        }
        $data = $query->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }
}
