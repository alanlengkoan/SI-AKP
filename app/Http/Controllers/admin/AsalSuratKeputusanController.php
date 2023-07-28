<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\AsalSuratKeputusan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AsalSuratKeputusanController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Asal Surat Keputusan', 'asal_surat_keputusan', 'view');
    }

    public function get(Request $request)
    {
        $response = AsalSuratKeputusan::find($request->id);

        return response()->json($response);
    }

    public function get_all()
    {
        $response = AsalSuratKeputusan::select('id_asal_surat_keputusan AS id', 'nama AS text')->orderBy('id_asal_surat_keputusan', 'desc')->get();

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = AsalSuratKeputusan::orderBy('id_asal_surat_keputusan', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            AsalSuratKeputusan::updateOrCreate(
                [
                    'id_asal_surat_keputusan' => $request->id_asal_surat_keputusan,
                ],
                [
                    'nama'     => $request->nama,
                    'email'    => $request->email,
                    'telepon'  => $request->telepon,
                    'alamat'   => $request->alamat,
                    'fax'      => $request->fax,
                    'website'  => $request->website,
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
            $asal_surat_keputusan = AsalSuratKeputusan::find($request->id);

            $asal_surat_keputusan->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
