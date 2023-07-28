<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\AsalSuratKeputusan;
use App\Models\Jabatan;
use App\Models\JenisSkpp;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\PegawaiBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PegawaiController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'operator');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Pegawai', 'pegawai', 'view');
    }

    public function add()
    {
        return Template::load($this->session['roles'], 'Tambah Pegawai', 'pegawai', 'add');
    }

    public function upd($any)
    {
        $id_pegawai = my_decrypt($any);

        $pegawai = Pegawai::find($id_pegawai);

        $pegawai_berkas = DB::select("SELECT jbs.id_jenis_berkas_skpp, jbs.id_jenis_skpp, jbs.id_berkas_skpp, js.nama AS jenis_skpp, bs.nama AS berkas_skpp, bs.jumlah, pb.file FROM jenis_berkas_skpp AS jbs LEFT JOIN jenis_skpp AS js ON js.id_jenis_skpp = jbs.id_jenis_skpp LEFT JOIN berkas_skpp AS bs ON bs.id_berkas_skpp = jbs.id_berkas_skpp LEFT JOIN( SELECT pegawai_berkas.id_berkas_skpp, pegawai_berkas.file FROM pegawai_berkas WHERE pegawai_berkas.id_pegawai = '$id_pegawai') AS pb ON pb.id_berkas_skpp = jbs.id_berkas_skpp WHERE jbs.id_jenis_skpp = '$pegawai->id_jenis_skpp' ORDER BY jbs.id_jenis_berkas_skpp desc");

        $data = [
            'pegawai'              => $pegawai,
            'pegawai_berkas'       => $pegawai_berkas,
            'pangkat'              => Pangkat::all(),
            'jabatan'              => Jabatan::all(),
            'asal_surat_keputusan' => AsalSuratKeputusan::all(),
            'jenis_skpp'           => JenisSkpp::all(),
        ];

        return Template::load($this->session['roles'], 'Ubah Pegawai', 'pegawai', 'upd', $data);
    }

    public function get_all()
    {
        $get = Pegawai::select('id_pegawai', 'nip', 'nama')->orderBy('nip', 'desc')->get();

        $response = [];

        foreach ($get as $value) {
            $response[] = [
                'id'   => $value->id_pegawai,
                'text' => $value->nip . ' | ' . $value->nama,
            ];
        }

        return response()->json($response);
    }

    public function get_data_dt()
    {
        $data = Pegawai::with(['toJabatan', 'toPangkat', 'toJenisSkpp', 'toAsalSuratKeputusan'])->orderBy('id_pegawai', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('operator.pegawai.upd', my_encrypt($row->id_pegawai)) . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;Ubah</a>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_pegawai) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                ';
            })
            ->make(true);
    }

    public function save(Request $request)
    {
        try {
            if ($request->id_pegawai === null) {
                $pegawai = new Pegawai();

                $nama_foto = add_picture($request->foto);

                $pegawai->id_jabatan               = $request->id_jabatan;
                $pegawai->id_pangkat               = $request->id_pangkat;
                $pegawai->id_jenis_skpp            = $request->id_jenis_skpp;
                $pegawai->id_asal_surat_keputusan  = $request->id_asal_surat_keputusan;
                $pegawai->no_asal_surat_keputusan  = $request->no_asal_surat_keputusan;
                $pegawai->tgl_asal_surat_keputusan = $request->tgl_asal_surat_keputusan;
                $pegawai->no_sp2d                  = $request->no_sp2d;
                $pegawai->tgl_sp2d                 = $request->tgl_sp2d;
                $pegawai->nama                     = $request->nama;
                $pegawai->nip                      = $request->nip;
                $pegawai->gaji                     = (empty($request->gaji) ? 0 : remove_separator($request->gaji));
                $pegawai->foto                     = $nama_foto;
                $pegawai->mutasi                   = $request->mutasi ?? '-';
                $pegawai->kelamin                  = $request->kelamin;
                $pegawai->tmp_tugas                = $request->tmp_tugas;
                $pegawai->tgl_pelapor              = "{$request->tgl_pelapor}-01";
                $pegawai->tgl_pensiun              = $request->tgl_pensiun;
                $pegawai->status_skpp              = '0';
                $pegawai->status_menikah           = $request->status_menikah;
                $pegawai->status_meninggal         = $request->status_meninggal;
                $pegawai->by_users                 = $this->session['id_users'];

                $pegawai->save();

                $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'redirect' => route('operator.pegawai.berkas.add', my_encrypt($pegawai->id_pegawai))];
            } else {
                $pegawai = Pegawai::find($request->id_pegawai);

                if (isset($request->change_picture) && $request->change_picture === 'on') {
                    $nama_foto = upd_picture($request->foto, $pegawai->foto);

                    $pegawai->foto = $nama_foto;
                }

                $pegawai->id_jabatan               = $request->id_jabatan;
                $pegawai->id_pangkat               = $request->id_pangkat;
                $pegawai->id_jenis_skpp            = $request->id_jenis_skpp;
                $pegawai->id_asal_surat_keputusan  = $request->id_asal_surat_keputusan;
                $pegawai->no_asal_surat_keputusan  = $request->no_asal_surat_keputusan;
                $pegawai->tgl_asal_surat_keputusan = $request->tgl_asal_surat_keputusan;
                $pegawai->no_sp2d                  = $request->no_sp2d;
                $pegawai->tgl_sp2d                 = $request->tgl_sp2d;
                $pegawai->nama                     = $request->nama;
                $pegawai->nip                      = $request->nip;
                $pegawai->gaji                     = (empty($request->gaji) ? 0 : remove_separator($request->gaji));
                $pegawai->mutasi                   = $request->mutasi ?? '-';
                $pegawai->kelamin                  = $request->kelamin;
                $pegawai->tmp_tugas                = $request->tmp_tugas;
                $pegawai->tgl_pelapor              = "{$request->tgl_pelapor}-01";
                $pegawai->tgl_pensiun              = $request->tgl_pensiun;
                $pegawai->status_menikah           = $request->status_menikah;
                $pegawai->status_meninggal         = $request->status_meninggal;
                $pegawai->by_users                 = $this->session['id_users'];

                $pegawai->save();

                $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'redirect' => route('operator.pegawai.upd', my_encrypt($pegawai->id_pegawai))];
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }

    public function del(Request $request)
    {
        try {
            $pegawai = Pegawai::find(my_decrypt($request->id));

            del_picture($pegawai->foto);

            $pegawai_berkas = PegawaiBerkas::where('id_pegawai', $pegawai->id_pegawai)->get();

            foreach ($pegawai_berkas as $key => $value) {
                del_picture($value->file);
            }

            $pegawai->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
