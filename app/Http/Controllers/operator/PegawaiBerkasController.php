<?php

namespace App\Http\Controllers\operator;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Pegawai;
use App\Models\PegawaiBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

use function Psy\debug;

class PegawaiBerkasController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'operator');
    }

    public function add($any)
    {
        $id_pegawai = my_decrypt($any);

        $pegawai = Pegawai::find($id_pegawai);

        $jenis_berkas_skpp = DB::select("SELECT jbs.id_jenis_berkas_skpp, jbs.id_jenis_skpp, jbs.id_berkas_skpp, js.nama AS jenis_skpp, bs.nama AS berkas_skpp, bs.jumlah, pb.file FROM jenis_berkas_skpp AS jbs LEFT JOIN jenis_skpp AS js ON js.id_jenis_skpp = jbs.id_jenis_skpp LEFT JOIN berkas_skpp AS bs ON bs.id_berkas_skpp = jbs.id_berkas_skpp LEFT JOIN( SELECT pegawai_berkas.id_berkas_skpp, pegawai_berkas.file FROM pegawai_berkas WHERE pegawai_berkas.id_pegawai = '$id_pegawai') AS pb ON pb.id_berkas_skpp = jbs.id_berkas_skpp WHERE jbs.id_jenis_skpp = '$pegawai->id_jenis_skpp' ORDER BY jbs.id_jenis_berkas_skpp DESC");

        $data = [
            'pegawai'           => $pegawai,
            'jenis_berkas_skpp' => $jenis_berkas_skpp,
        ];

        return Template::load($this->session['roles'], 'Berkas Pegawai', 'pegawai', 'berkas', $data);
    }

    public function check(Request $request)
    {
        $check = DB::select("SELECT COUNT(*) AS jumlah FROM jenis_berkas_skpp AS jbs LEFT JOIN( SELECT pegawai_berkas.id_berkas_skpp, pegawai_berkas.file FROM pegawai_berkas WHERE pegawai_berkas.id_pegawai = '$request->id_pegawai') AS pb ON pb.id_berkas_skpp = jbs.id_berkas_skpp WHERE jbs.id_jenis_skpp = '$request->id_jenis_skpp' AND pb.file IS NULL");

        if ($check[0]->jumlah > 0) {
            $response = ['status' => false, 'title' => 'Gagal!', 'text' => 'Terdapat berkas belum diupload', 'type' => 'warning', 'button' => 'Ok!'];
        } else {
            $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'redirect' => route('operator.pegawai.upd', my_encrypt($request->id_pegawai))];
        }

        return Response::json($response);
    }

    public function save(Request $request)
    {
        try {
            $id_berkas_skpp = $request->id_berkas_skpp;
            $id_pegawai     = $request->id_pegawai;
            $aksi           = $request->aksi;

            if ($aksi == 'add') {

                $check_pegawai_berkas = PegawaiBerkas::where('id_berkas_skpp', '=', $id_berkas_skpp)->where('id_pegawai', '=', $id_pegawai)->first();

                if ($check_pegawai_berkas === null) {
                    $pegawai_berkas_ins = new PegawaiBerkas();

                    if ($request->file->extension() == 'pdf') {
                        $nama_file = add_doc($request->file);
                    } else {
                        $nama_file = add_picture($request->file);
                    }

                    $pegawai_berkas_ins->id_pegawai     = $id_pegawai;
                    $pegawai_berkas_ins->id_berkas_skpp = $id_berkas_skpp;
                    $pegawai_berkas_ins->file           = $nama_file;
                    $pegawai_berkas_ins->by_users       = $this->session['id_users'];

                    $pegawai_berkas_ins->save();
                } else {
                    $pegawai_berkas_upd = PegawaiBerkas::where('id_berkas_skpp', '=', $id_berkas_skpp)->where('id_pegawai', '=', $id_pegawai)->first();

                    $nama_file = upd_picture($request->file, $pegawai_berkas_upd->file);

                    $pegawai_berkas_upd->file     = $nama_file;
                    $pegawai_berkas_upd->by_users = $this->session['id_users'];

                    $pegawai_berkas_upd->save();
                }

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
            } else {
                $check_pegawai_berkas = PegawaiBerkas::where('id_berkas_skpp', '=', $id_berkas_skpp)->where('id_pegawai', '=', $id_pegawai)->first();

                if ($check_pegawai_berkas === null) {
                    $pegawai_berkas_ins = new PegawaiBerkas();

                    $nama_file = add_picture($request->file);

                    $pegawai_berkas_ins->id_pegawai     = $id_pegawai;
                    $pegawai_berkas_ins->id_berkas_skpp = $id_berkas_skpp;
                    $pegawai_berkas_ins->file           = $nama_file;

                    $pegawai_berkas_ins->save();
                } else {
                    $pegawai_berkas_upd = PegawaiBerkas::where('id_berkas_skpp', '=', $id_berkas_skpp)->where('id_pegawai', '=', $id_pegawai)->first();

                    if ($request->file->extension() == 'pdf') {
                        $nama_file = upd_doc($request->file, $pegawai_berkas_upd->file);
                    } else {
                        $nama_file = upd_picture($request->file, $pegawai_berkas_upd->file);
                    }

                    $pegawai_berkas_upd->file = $nama_file;

                    $pegawai_berkas_upd->save();
                }

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!'];
            }
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
