<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        $jenis_skpp = DB::select("SELECT js.id_jenis_skpp, js.nama, IFNULL( pa.total, 0) AS total FROM jenis_skpp AS js LEFT JOIN( SELECT p.id_jenis_skpp, COUNT(*) AS total FROM pegawai AS p WHERE p.status_skpp = '1' GROUP BY p.id_jenis_skpp) AS pa ON pa.id_jenis_skpp = js.id_jenis_skpp");
        $total_skpp = DB::select("SELECT SUM( IFNULL( pa.total, 0)) AS total FROM jenis_skpp AS js LEFT JOIN( SELECT p.id_jenis_skpp, COUNT(*) AS total FROM pegawai AS p WHERE p.status_skpp = '1' GROUP BY p.id_jenis_skpp) AS pa ON pa.id_jenis_skpp = js.id_jenis_skpp");

        $data = [
            'jenis_skpp' => $jenis_skpp,
            'total_skpp' => $total_skpp[0]->total,
        ];
        return Template::load($this->session['roles'], 'Dashboard', 'dashboard', 'view', $data);
    }
}
