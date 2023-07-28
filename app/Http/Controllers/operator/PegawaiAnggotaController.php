<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Models\PegawaiAnggota;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PegawaiAnggotaController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'operator');
    }

    public function get(Request $request)
    {
        $response = PegawaiAnggota::find($request->id);

        return response()->json($response);
    }

    public function get_data_dt(Request $request)
    {
        $data = PegawaiAnggota::with(['toJenisAnggota'])->where('pegawai_anggota.id_pegawai', '=', $request->id_pegawai)->orderBy('pegawai_anggota.id_pegawai_anggota', 'desc')->get();

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function save(Request $request)
    {
        try {
            PegawaiAnggota::updateOrCreate(
                [
                    'id_pegawai_anggota' => $request->id_pegawai_anggota,
                ],
                [
                    'id_jenis_anggota'  => $request->id_jenis_anggota_pegawai_anggota,
                    'id_pegawai'        => $request->id_pegawai,
                    'nama'              => $request->nama_pegawai_anggota,
                    'kelamin'           => $request->kelamin_pegawai_anggota,
                    'tgl_lahir'         => $request->tgl_lahir_pegawai_anggota,
                    'tmp_lahir'         => $request->tmp_lahir_pegawai_anggota,
                    'keterangan'        => $request->keterangan_pegawai_anggota,
                    'status_tanggungan' => $request->status_tanggungan_pegawai_anggota,
                    'by_users'          => $this->session['id_users'],
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
            $pegawai = PegawaiAnggota::find($request->id);

            $pegawai->delete();

            del_picture($pegawai->foto);

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
