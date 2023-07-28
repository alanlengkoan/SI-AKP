<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\JenisAnggota;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisAnggotaController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Jenis Anggota Keluarga', 'jenis_anggota', 'view');
    }

    public function get(Request $request)
    {
        $response = JenisAnggota::find($request->id);

        return response()->json($response);
    }

    public function get_all()
    {
        $response = JenisAnggota::select('id_jenis_anggota AS id', 'nama AS text')->orderBy('id_jenis_anggota', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = JenisAnggota::orderBy('id_jenis_anggota', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            JenisAnggota::updateOrCreate(
                [
                    'id_jenis_anggota' => $request->id_jenis_anggota,
                ],
                [
                    'nama'     => $request->nama,
                    'by_users' => $this->session['id_users'],
                ]
            );

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }

    public function del(Request $request)
    {
        try {
            $jenis_anggota = JenisAnggota::find($request->id);

            $jenis_anggota->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
