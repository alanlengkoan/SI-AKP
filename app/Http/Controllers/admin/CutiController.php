<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class CutiController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Cuti', 'cuti', 'view');
    }

    public function get_data_dt()
    {
        $data = Cuti::with(['toPegawai.toUsers'])->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_cuti) . '" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_cuti) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = Cuti::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        try {
            Cuti::updateOrCreate(
                [
                    'id_cuti' => $request->id_cuti,
                ],
                [
                    'id_pegawai'  => $request->id_pegawai,
                    'tipe_cuti'   => $request->tipe_cuti,
                    'tgl_mulai'   => $request->tgl_mulai,
                    'tgl_selesai' => $request->tgl_selesai,
                    'by_users'    => $this->session['id_users'],
                ]
            );

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        try {
            $data = Cuti::find(my_decrypt($request->id));

            $data->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return Response::json($response);
    }
}
