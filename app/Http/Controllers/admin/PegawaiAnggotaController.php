<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PegawaiAnggota;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PegawaiAnggotaController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function get_all(Request $request)
    {
        $response = PegawaiAnggota::select('id_pegawai_anggota AS id', 'nama AS text')->where('id_pegawai', '=', $request->id_pegawai)->where('status_tanggungan', '=', 'y')->orderBy('id_pegawai_anggota', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt(Request $request)
    {
        $data = PegawaiAnggota::with(['toJenisAnggota'])->where('pegawai_anggota.id_pegawai', '=', $request->id_pegawai)->orderBy('pegawai_anggota.id_pegawai_anggota', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }
}
