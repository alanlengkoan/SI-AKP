<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Pegawai;
use App\Models\PegawaiPangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class PegawaiPangkatController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Kenaikan Pangkat', 'pegawai/pangkat', 'view');
    }

    public function get_data_dt(Request $request)
    {
        $query = PegawaiPangkat::query();
        if (isset($request->id_pegawai)) {
            $query->whereIdPegawai($request->id_pegawai);
        }
        $data = $query->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('pegawai', function ($row) {
                return $row->toPegawai->nip . ' | ' . $row->toPegawai->nama;
            })
            ->addColumn('pangkat', function ($row) {
                return $row->toPangkat->nama;
            })
            ->addColumn('tmt', function ($row) {
                return tgl_indo($row->tmt);
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_pegawai_pangkat) . '" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_pegawai_pangkat) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = PegawaiPangkat::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        try {
            PegawaiPangkat::updateOrCreate(
                [
                    'id_pegawai_pangkat' => $request->id_pegawai_pangkat,
                ],
                [
                    'id_pegawai' => $request->id_pegawai,
                    'id_pangkat' => $request->id_pangkat,
                    'tmt'        => $request->tmt,
                    'by_users'   => $this->session['id_users'],
                ]
            );

            $pegawai = Pegawai::find($request->id_pegawai);
            $pegawai->update([
                'id_pangkat' => $request->id_pangkat,
                'tmt'        => $request->tmt,
                'by_users'   => $this->session['id_users'],
            ]);

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        try {
            $data = PegawaiPangkat::find(my_decrypt($request->id));

            $data->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return Response::json($response);
    }
}
