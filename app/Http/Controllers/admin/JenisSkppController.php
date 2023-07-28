<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\JenisSkpp;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisSkppController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Jenis SKPP', 'jenis_skpp', 'view');
    }

    public function get(Request $request)
    {
        $response = JenisSkpp::find($request->id);

        return response()->json($response);
    }

    public function get_all()
    {
        $response = JenisSkpp::select('id_jenis_skpp AS id', 'nama AS text')->orderBy('id_jenis_skpp', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = JenisSkpp::orderBy('id_jenis_skpp', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            JenisSkpp::updateOrCreate(
                [
                    'id_jenis_skpp' => $request->id_jenis_skpp,
                ],
                [
                    'nama'     => $request->nama,
                    'kode'     => $request->kode,
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
            $jenis_skpp = JenisSkpp::find($request->id);

            $jenis_skpp->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
