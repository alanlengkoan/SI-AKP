<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\JenisGaji;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisGajiController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Jenis Gaji', 'jenis_gaji', 'view');
    }

    public function get(Request $request)
    {
        $response = JenisGaji::find($request->id);

        return response()->json($response);
    }

    public function get_all()
    {
        $response = JenisGaji::select('id_jenis_gaji AS id', 'nama AS text')->orderBy('id_jenis_gaji', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = JenisGaji::orderBy('id_jenis_gaji', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            JenisGaji::updateOrCreate(
                [
                    'id_jenis_gaji' => $request->id_jenis_gaji,
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
            $jenis_gaji = JenisGaji::find($request->id);

            $jenis_gaji->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
