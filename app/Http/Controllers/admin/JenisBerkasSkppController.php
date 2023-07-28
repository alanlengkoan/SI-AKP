<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\JenisBerkasSkpp;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JenisBerkasSkppController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Jenis Berkas SKPP', 'jenis_berkas_skpp', 'view');
    }

    public function get(Request $request)
    {
        $response = JenisBerkasSkpp::find($request->id);

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = JenisBerkasSkpp::with(['toJenisSkpp', 'toBerkasSkpp'])->orderBy('id_jenis_berkas_skpp', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            JenisBerkasSkpp::updateOrCreate(
                [
                    'id_jenis_berkas_skpp' => $request->id_jenis_berkas_skpp,
                ],
                [
                    'id_jenis_skpp'  => $request->id_jenis_skpp,
                    'id_berkas_skpp' => $request->id_berkas_skpp,
                    'by_users'       => $this->session['id_users'],
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
            $jenis_berkas_skpp = JenisBerkasSkpp::find($request->id);

            $jenis_berkas_skpp->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
