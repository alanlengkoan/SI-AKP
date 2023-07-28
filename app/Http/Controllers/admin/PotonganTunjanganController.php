<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\PotonganTunjangan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PotonganTunjanganController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Potongan Tunjangan', 'potongan_tunjangan', 'view');
    }

    public function get(Request $request)
    {
        $response = PotonganTunjangan::find($request->id);

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = PotonganTunjangan::with(['toPotongan', 'toTunjangan'])->orderBy('id_potongan_tunjangan', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            PotonganTunjangan::updateOrCreate(
                [
                    'id_potongan_tunjangan' => $request->id_potongan_tunjangan,
                ],
                [
                    'id_potongan'  => $request->id_potongan,
                    'id_tunjangan' => $request->id_tunjangan,
                    'by_users'     => $this->session['id_users'],
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
            $potongan_tunjangan = PotonganTunjangan::find($request->id);

            $potongan_tunjangan->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
