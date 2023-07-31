<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Pegawai;
use App\Models\PegawaiPangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class PegawaiController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Pegawai', 'pegawai', 'view');
    }

    public function det($id)
    {
        $id_pegawai = my_decrypt($id);

        // pegawai
        $pegawai = Pegawai::with(['toAgama', 'toJabatan', 'toPangkat', 'toPendidikan'])->find($id_pegawai);

        $data = [
            'pegawai' => $pegawai,
        ];

        return Template::load($this->session['roles'], 'Detail Pegawai', 'pegawai', 'det', $data);
    }

    public function get_all()
    {
        $get = Pegawai::select('id_pegawai', 'nip', 'nama')->whereStatus('1')->orderBy('nip', 'desc')->get();

        $response = [];

        foreach ($get as $value) {
            $response[] = [
                'id'   => $value->id_pegawai,
                'text' => $value->nip . ' | ' . $value->nama,
            ];
        }

        return Response::json($response);
    }

    public function get_data_dt(Request $request)
    {
        $data = Pegawai::whereStatus($request->status)->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('agama', function ($row) {
                return $row->toAgama->nama;
            })
            ->addColumn('jabatan', function ($row) {
                return $row->toJabatan->nama;
            })
            ->addColumn('pangkat', function ($row) {
                return $row->toPangkat->nama;
            })
            ->addColumn('pendidikan', function ($row) {
                return $row->toPendidikan->nama;
            })
            ->addColumn('tmt', function ($row) {
                return tgl_indo($row->tmt);
            })
            ->addColumn('tgl_lahir', function ($row) {
                return tgl_indo($row->tgl_lahir);
            })
            ->addColumn('kelamin', function ($row) {
                return ($row->kelamin === 'L' ? 'Laki-laki' : 'Perempuan');
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin.pegawai.det', my_encrypt($row->id_pegawai)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>&nbsp;
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_pegawai) . '" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_pegawai) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = Pegawai::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(Request $request)
    {
        try {
            if ($request->id_pegawai === null) {
                $pegawai = Pegawai::create([
                    'id_agama'      => $request->id_agama,
                    'id_jabatan'    => $request->id_jabatan,
                    'id_pangkat'    => $request->id_pangkat,
                    'id_pendidikan' => $request->id_pendidikan,
                    'nip'           => $request->nip,
                    'tmt'           => $request->tmt,
                    'nama'          => $request->nama,
                    'kelamin'       => $request->kelamin,
                    'tmp_lahir'     => $request->tmp_lahir,
                    'tgl_lahir'     => $request->tgl_lahir,
                    'status'        => $request->status,
                    'by_users'      => $this->session['id_users'],
                ]);

                PegawaiPangkat::create([
                    'id_pegawai' => $pegawai->id_pegawai,
                    'id_pangkat' => $request->id_pangkat,
                    'tmt'        => $request->tmt,
                    'by_users'   => $this->session['id_users'],
                ]);

                $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
            } else {
                $pegawai = Pegawai::find($request->id_pegawai);
                $pegawai->update([
                    'id_agama'      => $request->id_agama,
                    'id_jabatan'    => $request->id_jabatan,
                    'id_pangkat'    => $request->id_pangkat,
                    'id_pendidikan' => $request->id_pendidikan,
                    'nip'           => $request->nip,
                    'tmt'           => $request->tmt,
                    'nama'          => $request->nama,
                    'kelamin'       => $request->kelamin,
                    'tmp_lahir'     => $request->tmp_lahir,
                    'tgl_lahir'     => $request->tgl_lahir,
                    'status'        => $request->status,
                    'by_users'      => $this->session['id_users'],
                ]);

                $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        try {
            $data = Pegawai::find(my_decrypt($request->id));

            $data->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return Response::json($response);
    }
}
