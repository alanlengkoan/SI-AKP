<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\AmpraGaji;
use App\Models\AmpraGajiPotongan;
use App\Models\AmpraGajiTunjangan;
use App\Models\Pegawai;
use App\Models\Ttd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AmpraGajiController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index()
    {
        return Template::load($this->session['roles'], 'Buat SKPP', 'ampra_gaji', 'view');
    }

    public function add()
    {
        return Template::load($this->session['roles'], 'Tambah SKPP', 'ampra_gaji', 'add');
    }

    public function upd($id)
    {
        $id_ampra_gaji = my_decrypt($id);

        $data = [
            'ampra_gaji' => AmpraGaji::find($id_ampra_gaji),
            'pegawai'    => Pegawai::all(),
            'ttd'        => Ttd::all(),
        ];

        return Template::load($this->session['roles'], 'Ubah SKPP', 'ampra_gaji', 'upd', $data);
    }

    public function det($id)
    {
        $id_ampra_gaji = my_decrypt($id);

        // ampra gaji
        $ampra_gaji = AmpraGaji::find($id_ampra_gaji);

        // ampra gaji tunjangan
        $ampra_gaji_tunjangan = AmpraGajiTunjangan::with(['toTunjangan'])->where('ampra_gaji_tunjangan.id_ampra_gaji', '=', $id_ampra_gaji)->where('ampra_gaji_tunjangan.nilai', '!=', 0)->get();

        // ampra gaji potongan
        $ampra_gaji_potongan = AmpraGajiPotongan::with(['toPotongan'])->where('ampra_gaji_potongan.id_ampra_gaji', '=', $id_ampra_gaji)->where('ampra_gaji_potongan.nilai', '!=', 0)->get();

        $data = [
            'ampra_gaji'           => $ampra_gaji,
            'ampra_gaji_tunjangan' => $ampra_gaji_tunjangan,
            'ampra_gaji_potongan'  => $ampra_gaji_potongan
        ];

        return Template::load($this->session['roles'], 'Detail SKPP', 'ampra_gaji', 'det', $data);
    }

    public function tunjangan($any)
    {
        $id_ampra_gaji = my_decrypt($any);

        $ampra_gaji = AmpraGaji::find($id_ampra_gaji);

        $tunjangan = DB::select("SELECT t.id_tunjangan, t.nama, a.nilai FROM tunjangan AS t LEFT JOIN( SELECT agt.id_tunjangan, agt.nilai FROM ampra_gaji_tunjangan AS agt WHERE agt.id_ampra_gaji = '$id_ampra_gaji') AS a ON a.id_tunjangan = t.id_tunjangan ORDER BY t.id_tunjangan");

        $data = [
            'ampra_gaji' => $ampra_gaji,
            'tunjangan'  => $tunjangan
        ];

        return Template::load($this->session['roles'], 'Tambah Ampra Gaji', 'ampra_gaji', 'tunjangan', $data);
    }

    public function potongan($any)
    {
        $id_ampra_gaji = my_decrypt($any);

        $ampra_gaji = AmpraGaji::find($id_ampra_gaji);

        $ampra_gaji_tunjangan = AmpraGajiTunjangan::with(['toTunjangan'])->where('ampra_gaji_tunjangan.id_ampra_gaji', '=', $id_ampra_gaji)->get();

        $potongan = DB::select("SELECT p.id_potongan, p.nama, p.persen, pp.total FROM potongan AS p LEFT JOIN( SELECT pt.id_potongan, SUM( agt.nilai) AS total FROM potongan_tunjangan AS pt RIGHT JOIN ampra_gaji_tunjangan AS agt ON pt.id_tunjangan = agt.id_tunjangan WHERE agt.id_ampra_gaji = '$id_ampra_gaji' GROUP BY pt.id_potongan) AS pp ON pp.id_potongan = p.id_potongan");

        $data = [
            'ampra_gaji'           => $ampra_gaji,
            'ampra_gaji_tunjangan' => $ampra_gaji_tunjangan,
            'potongan'             => $potongan
        ];

        return Template::load($this->session['roles'], 'Tambah Ampra Gaji', 'ampra_gaji', 'potongan', $data);
    }

    public function get_data_dt()
    {
        $data = AmpraGaji::with(['toPegawai.toJabatan', 'toPegawai.toPangkat', 'toPegawai.toJenisSkpp', 'toPegawai.toAsalSuratKeputusan'])->orderBy('ampra_gaji.id_pegawai', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin.kartu_gaji.print', my_encrypt($row->id_ampra_gaji)) . '" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a>&nbsp;
                    <a href="' . route('admin.ampra_gaji.upd', my_encrypt($row->id_ampra_gaji)) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>&nbsp;Ubah</a>&nbsp;
                    <a href="' . route('admin.ampra_gaji.det', my_encrypt($row->id_ampra_gaji)) . '" class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_ampra_gaji) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                ';
            })
            ->make(true);
    }

    public function save(Request $request)
    {
        try {
            if ($request->id_ampra_gaji === null) {
                $ampra_gaji = new AmpraGaji();
                $ampra_gaji->id_pegawai = $request->id_pegawai;
                $ampra_gaji->id_ttd     = $request->id_ttd;
                $ampra_gaji->no_surat   = $request->no_surat;
                $ampra_gaji->tgl_surat  = $request->tgl_surat;
                $ampra_gaji->by_users   = $this->session['id_users'];
                $ampra_gaji->save();

                $pegawai = Pegawai::find($request->id_pegawai);
                $pegawai->status_skpp = '1';
                $pegawai->save();

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'redirect' => route('admin.ampra_gaji.tunjangan', my_encrypt($ampra_gaji->id_ampra_gaji))];
            } else {
                $id_ampra_gaji = $request->id_ampra_gaji;
                $tahap         = $request->tahap;

                if ($tahap === 'tunjangan') {
                    // delete ampra gaji tunjangan
                    $ampra_gaji_tunjangan_del = AmpraGajiTunjangan::where('id_ampra_gaji', '=', $id_ampra_gaji);
                    $ampra_gaji_tunjangan_del->delete();

                    // tunjangan
                    $id_tunjangan = $request->id_tunjangan;
                    $nilai        = $request->nilai;

                    for ($i = 0; $i < count($id_tunjangan); $i++) {
                        $ampra_gaji_tunjangan[] = [
                            'id_ampra_gaji' => $id_ampra_gaji,
                            'id_tunjangan'  => $id_tunjangan[$i],
                            'nilai'         => remove_separator($nilai[$i]),
                            'by_users'      => $this->session['id_users'],
                        ];
                    }

                    AmpraGajiTunjangan::insert($ampra_gaji_tunjangan);

                    $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'redirect' => route('admin.ampra_gaji.potongan', my_encrypt($id_ampra_gaji))];
                } else if ($tahap === 'potongan') {
                    // delete ampra gaji potongan
                    $ampra_gaji_potongan_del = AmpraGajiPotongan::where('id_ampra_gaji', '=', $id_ampra_gaji);
                    $ampra_gaji_potongan_del->delete();

                    // potongan
                    $id_potongan = $request->id_potongan;
                    $nilai       = $request->nilai;

                    for ($i = 0; $i < count($id_potongan); $i++) {
                        $ampra_gaji_potongan[] = [
                            'id_ampra_gaji' => $id_ampra_gaji,
                            'id_potongan'   => $id_potongan[$i],
                            'nilai'         => remove_separator($nilai[$i]),
                            'by_users'      => $this->session['id_users'],
                        ];
                    }

                    AmpraGajiPotongan::insert($ampra_gaji_potongan);

                    $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'redirect' => route('admin.ampra_gaji.det', my_encrypt($id_ampra_gaji))];
                } else {
                    $ampra_gaji = AmpraGaji::find($id_ampra_gaji);
                    $ampra_gaji->id_pegawai = $request->id_pegawai;
                    $ampra_gaji->id_ttd     = $request->id_ttd;
                    $ampra_gaji->no_surat   = $request->no_surat;
                    $ampra_gaji->tgl_surat  = $request->tgl_surat;
                    $ampra_gaji->by_users   = $this->session['id_users'];
                    $ampra_gaji->save();

                    $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!', 'redirect' => route('admin.ampra_gaji.tunjangan', my_encrypt($id_ampra_gaji))];
                }
            }
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }

    public function del(Request $request)
    {
        try {
            $ampra_gaji = AmpraGaji::find(my_decrypt($request->id));

            $ampra_gaji->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
