<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JabatanController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Jabatan', 'jabatan', 'view');
    }

    public function get(Request $request)
    {
        $response = Jabatan::find($request->id);

        return response()->json($response);
    }

    public function get_all()
    {
        $response = Jabatan::select('id_jabatan AS id', 'nama AS text')->orderBy('id_jabatan', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = Jabatan::orderBy('id_jabatan', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            Jabatan::updateOrCreate(
                [
                    'id_jabatan' => $request->id_jabatan,
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
            $jabatan = Jabatan::find($request->id);

            $jabatan->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
