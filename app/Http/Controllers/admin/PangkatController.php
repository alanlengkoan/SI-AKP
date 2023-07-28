<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Pangkat;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PangkatController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Pangkat', 'pangkat', 'view');
    }

    public function get(Request $request)
    {
        $response = Pangkat::find($request->id);

        return response()->json($response);
    }

    public function get_all()
    {
        $response = Pangkat::select('id_pangkat AS id', 'nama AS text')->orderBy('id_pangkat', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = Pangkat::orderBy('id_pangkat', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            Pangkat::updateOrCreate(
                [
                    'id_pangkat' => $request->id_pangkat,
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
            $pangkat = Pangkat::find($request->id);

            $pangkat->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
