<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Potongan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PotonganController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Potongan', 'potongan', 'view');
    }

    public function get(Request $request)
    {
        $response = Potongan::find($request->id);

        return response()->json($response);
    }

    public function get_all()
    {
        $response = Potongan::select('id_potongan AS id', 'nama AS text')->orderBy('id_potongan', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = Potongan::orderBy('id_potongan', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            Potongan::updateOrCreate(
                [
                    'id_potongan' => $request->id_potongan,
                ],
                [
                    'nama'     => $request->nama,
                    'persen'   => ($request->persen / 100),
                    'status'   => $request->status,
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
            $potongan = Potongan::find($request->id);

            $potongan->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
