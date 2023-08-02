<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Pdf;
use App\Libraries\Template;
use App\Models\Gapok;
use App\Models\Pegawai;
use App\Models\PegawaiPangkat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $pegawai = Pegawai::with(['toUsers', 'toAgama', 'toJabatan', 'toPangkat', 'toPendidikan'])->find($id_pegawai);
        // gaji pokok
        $mkg   = count_year($pegawai->tmt);
        $gapok = Gapok::whereIdPangkat($pegawai->id_pangkat)->where('dari', '<=', $mkg)->where('sampai', '>=', $mkg)->first();

        $data = [
            'pegawai' => $pegawai,
            'mkg'     => $mkg . ' Tahun',
            'gapok'   => $gapok,
        ];

        return Template::load($this->session['roles'], 'Detail Pegawai', 'pegawai', 'det', $data);
    }

    public function print($id)
    {
        $id_pegawai = my_decrypt($id);

        // pegawai
        $pegawai = Pegawai::with(['toUsers', 'toAgama', 'toJabatan', 'toPangkat', 'toPendidikan'])->find($id_pegawai);
        // pangkat & gaji pokok old
        $pangkat_old     = DB::select("SELECT pp.id_pegawai_pangkat, pp.id_pangkat, pp.tmt, p.nama FROM pegawai_pangkat AS pp LEFT JOIN pangkat AS p ON p.id_pangkat = pp.id_pangkat WHERE pp.id_pegawai = '$id_pegawai' ORDER BY pp.created_at DESC LIMIT 1,1");
        $pangkat_old_row = $pangkat_old[0];
        $mkg_old         = count_year($pangkat_old_row->tmt);
        $gapok_old       = Gapok::whereIdPangkat($pangkat_old_row->id_pangkat)->where('dari', '<=', $mkg_old)->where('sampai', '>=', $mkg_old)->first();

        $pangkat_new     = DB::select("SELECT pp.id_pegawai_pangkat, pp.id_pangkat, pp.tmt, p.nama FROM pegawai_pangkat AS pp LEFT JOIN pangkat AS p ON p.id_pangkat = pp.id_pangkat WHERE pp.id_pegawai = '$id_pegawai' ORDER BY pp.created_at DESC LIMIT 1");
        $pangkat_new_row = $pangkat_new[0];
        $mkg_new         = count_year($pangkat_new_row->tmt);
        $gapok_new       = Gapok::whereIdPangkat($pangkat_new_row->id_pangkat)->where('dari', '<=', $mkg_new)->where('sampai', '>=', $mkg_new)->first();

        $data = [
            'title'       => 'Surat Kenaikan Pangkat Pegawai Negeri Sipil',
            'pegawai'     => $pegawai,
            'pangkat_old' => $pangkat_old_row,
            'mkg_old'     => $mkg_old,
            'gapok_old'   => $gapok_old,
            'pangkat_new' => $pangkat_new_row,
            'gapok_new'   => $gapok_new,
        ];

        Pdf::printPdf('Kenaikan Gaji', 'admin.pegawai.print', '', '', $data);
    }

    public function get_all()
    {
        // $get = Pegawai::select('id_pegawai', 'nip', 'nama')->whereStatus('1')->orderBy('nip', 'desc')->get();
        $get = Pegawai::with(['toUsers'])->whereStatus('1')->orderBy('nip', 'desc')->get();

        $response = [];

        foreach ($get as $value) {
            $response[] = [
                'id'   => $value->id_pegawai,
                'text' => $value->nip . ' | ' . $value->toUsers->nama,
            ];
        }

        return Response::json($response);
    }

    public function get_data_dt(Request $request)
    {
        $data = Pegawai::whereStatus($request->status)->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($row) {
                return $row->toUsers->nama;
            })
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
                if ($row->toPegawaiPangkat->count() > 1) {
                    return '
                        <a href="' . route('admin.pegawai.print', my_encrypt($row->id_pegawai)) . '" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a>&nbsp;
                        <a href="' . route('admin.pegawai.det', my_encrypt($row->id_pegawai)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>&nbsp;
                        <button type="button" id="upd" data-id="' . my_encrypt($row->id_pegawai) . '" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                        <button type="button" id="del" data-id="' . my_encrypt($row->id_pegawai) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;<span>Hapus</span></button>
                    ';
                } else {
                    return '
                        <a href="' . route('admin.pegawai.det', my_encrypt($row->id_pegawai)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>&nbsp;
                        <button type="button" id="upd" data-id="' . my_encrypt($row->id_pegawai) . '" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                        <button type="button" id="del" data-id="' . my_encrypt($row->id_pegawai) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;<span>Hapus</span></button>
                    ';
                }
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $data = Pegawai::with(['toUsers'])->find(my_decrypt($request->id));

        $response = [
            'id_pegawai'   => $data->id_pegawai,
            'id_users'     => $data->id_users,
            'id_agama'     => $data->id_agama,
            'id_jabatan'   => $data->id_jabatan,
            'id_pangkat'   => $data->id_pangkat,
            'id_pendidikan' => $data->id_pendidikan,
            'nip'          => $data->nip,
            'nama'         => $data->toUsers->nama,
            'tmt'          => $data->tmt,
            'kelamin'      => $data->kelamin,
            'tmp_lahir'    => $data->tmp_lahir,
            'tgl_lahir'    => $data->tgl_lahir,
            'status'       => $data->status,
        ];

        return Response::json($response);
    }

    public function save(Request $request)
    {
        try {
            if ($request->id_pegawai === null) {
                $id_users = get_acak_id(User::class, 'id_users');

                DB::beginTransaction();
                User::create([
                    'id_users' => $id_users,
                    'nama'     => $request->nama,
                    'roles'    => 'pegawai',
                    'username' => $request->nip,
                    'password' => Hash::make('12345678'),
                    'active'   => 'y',
                ]);

                $pegawai = Pegawai::create([
                    'id_agama'      => $request->id_agama,
                    'id_users'      => $id_users,
                    'id_jabatan'    => $request->id_jabatan,
                    'id_pangkat'    => $request->id_pangkat,
                    'id_pendidikan' => $request->id_pendidikan,
                    'nip'           => $request->nip,
                    'tmt'           => $request->tmt,
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
                DB::commit();

                $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
            } else {
                $pegawai = Pegawai::find($request->id_pegawai);
                $users   = User::find($pegawai->id_users);

                $pegawai->update([
                    'id_agama'      => $request->id_agama,
                    'id_jabatan'    => $request->id_jabatan,
                    'id_pangkat'    => $request->id_pangkat,
                    'id_pendidikan' => $request->id_pendidikan,
                    'nip'           => $request->nip,
                    'tmt'           => $request->tmt,
                    'kelamin'       => $request->kelamin,
                    'tmp_lahir'     => $request->tmp_lahir,
                    'tgl_lahir'     => $request->tgl_lahir,
                    'status'        => $request->status,
                    'by_users'      => $this->session['id_users'],
                ]);

                $users->update([
                    'nama' => $request->nama,
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
