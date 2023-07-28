<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\BerkasSkpp;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BerkasSkppController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Berkas SKPP', 'berkas_skpp', 'view');
    }

    public function get(Request $request)
    {
        $response = BerkasSkpp::find($request->id);

        return response()->json($response);
    }

    public function get_all()
    {
        $response = BerkasSkpp::select('id_berkas_skpp AS id', 'nama AS text')->orderBy('id_berkas_skpp', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = BerkasSkpp::orderBy('id_berkas_skpp', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            BerkasSkpp::updateOrCreate(
                [
                    'id_berkas_skpp' => $request->id_berkas_skpp,
                ],
                [
                    'nama'     => $request->nama,
                    'jumlah'   => $request->jumlah,
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
            $berkas_skpp = BerkasSkpp::find($request->id);

            $berkas_skpp->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
