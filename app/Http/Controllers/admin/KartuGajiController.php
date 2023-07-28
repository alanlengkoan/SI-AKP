<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Pdf;
use App\Libraries\Template;
use App\Models\AmpraGaji;
use App\Models\AmpraGajiPotongan;
use App\Models\AmpraGajiTunjangan;
use App\Models\KartuGaji;
use App\Models\KartuGajiPotongan;
use App\Models\KartuGajiTunjangan;
use App\Models\PegawaiAnggota;
use App\Models\TKartuGajiTunjangan;
use App\Models\Ttd;
use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KartuGajiController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'admin');
    }

    public function index($any)
    {
        $id_ampra_gaji = my_decrypt($any);

        $data = [
            'ampra_gaji' => AmpraGaji::find($id_ampra_gaji),
        ];

        return Template::load($this->session['roles'], 'Kartu Gaji', 'kartu_gaji', 'view', $data);
    }

    public function det($id, $any)
    {
        $id_ampra_gaji = my_decrypt($id);
        $id_kartu_gaji = my_decrypt($any);

        // ampra gaji
        $ampra_gaji = AmpraGaji::find($id_ampra_gaji);

        // kartu gaji
        $kartu_gaji = KartuGaji::find($id_kartu_gaji);

        // kartu gaji tunjangan
        $kartu_gaji_tunjangan = KartuGajiTunjangan::with(['toTunjangan'])->where('kartu_gaji_tunjangan.id_kartu_gaji', '=', $id_kartu_gaji)->where('kartu_gaji_tunjangan.nilai', '!=', 0)->get();

        // kartu gaji potongan
        $kartu_gaji_potongan = KartuGajiPotongan::with(['toPotongan'])->where('kartu_gaji_potongan.id_kartu_gaji', '=', $id_kartu_gaji)->where('kartu_gaji_potongan.nilai', '!=', 0)->get();

        $data = [
            'ampra_gaji'           => $ampra_gaji,
            'kartu_gaji'           => $kartu_gaji,
            'kartu_gaji_tunjangan' => $kartu_gaji_tunjangan,
            'kartu_gaji_potongan'  => $kartu_gaji_potongan
        ];

        return Template::load($this->session['roles'], 'Detail Kartu Gaji', 'kartu_gaji', 'det', $data);
    }

    public function print($id)
    {
        $id_ampra_gaji = my_decrypt($id);

        // pegawai
        $pegawai = AmpraGaji::find($id_ampra_gaji);

        // tanda tangan
        $ttd = Ttd::find($pegawai->id_ttd);

        // pegawai anggota
        $pegawai_anggota = PegawaiAnggota::where('status_tanggungan', '=', 'y')->where('id_pegawai', '=', $pegawai->id_pegawai)->orderBy('tgl_lahir', 'asc')->get();

        // ampra gaji tunjangan
        $ampra_gaji_tunjangan = AmpraGajiTunjangan::with(['toTunjangan'])->where('ampra_gaji_tunjangan.id_ampra_gaji', '=', $id_ampra_gaji)->where('ampra_gaji_tunjangan.nilai', '!=', 0)->get();

        // ampra gaji potongan
        $ampra_gaji_potongan = AmpraGajiPotongan::with(['toPotongan'])->where('ampra_gaji_potongan.id_ampra_gaji', '=', $id_ampra_gaji)->where('ampra_gaji_potongan.nilai', '!=', 0)->get();

        // kartu gaji tunjangan
        $kartu_gaji_tunjangan = DB::select("SELECT kgt.id_tunjangan, t.nama AS tunjangan, SUM( kgt.nilai) AS nilai FROM kartu_gaji AS kg LEFT JOIN ampra_gaji as ag on ag.id_ampra_gaji = kg.id_ampra_gaji LEFT JOIN kartu_gaji_tunjangan AS kgt ON kgt.id_kartu_gaji = kg.id_kartu_gaji LEFT JOIN tunjangan AS t ON t.id_tunjangan = kgt.id_tunjangan WHERE kg.id_ampra_gaji = '$id_ampra_gaji' GROUP BY kgt.id_tunjangan HAVING SUM( kgt.nilai) != 0");

        // kartu gaji potongan
        $kartu_gaji_potongan = DB::select("SELECT kgp.id_potongan, p.nama AS potongan, SUM( kgp.nilai) AS nilai FROM kartu_gaji AS kg LEFT JOIN ampra_gaji AS ag ON ag.id_ampra_gaji = kg.id_ampra_gaji LEFT JOIN kartu_gaji_potongan AS kgp ON kgp.id_kartu_gaji = kg.id_kartu_gaji LEFT JOIN potongan AS p ON p.id_potongan = kgp.id_potongan WHERE kg.id_ampra_gaji = '$id_ampra_gaji' GROUP BY kgp.id_potongan HAVING SUM( kgp.nilai) != 0");

        // total tunjangan
        $total_tunjangan = DB::select("SELECT SUM( kgt.nilai) AS nilai FROM kartu_gaji AS kg LEFT JOIN ampra_gaji AS ag ON ag.id_ampra_gaji = kg.id_ampra_gaji LEFT JOIN kartu_gaji_tunjangan AS kgt ON kgt.id_kartu_gaji = kg.id_kartu_gaji LEFT JOIN tunjangan AS t ON t.id_tunjangan = kgt.id_tunjangan WHERE kg.id_ampra_gaji = '$id_ampra_gaji'");

        // pengembalian tunjangan
        $pengembalian = DB::select("SELECT pe.id_tunjangan, tu.nama,( SELECT bulan FROM pengembalian_view AS po WHERE po.id_ampra_gaji = pe.id_ampra_gaji AND po.id_tunjangan = pe.id_tunjangan ORDER BY po.tahun ASC, po.bulan ASC LIMIT 1) AS bulan_min,( SELECT tahun FROM pengembalian_view AS po WHERE po.id_ampra_gaji = pe.id_ampra_gaji AND po.id_tunjangan = pe.id_tunjangan ORDER BY po.tahun ASC, po.bulan ASC LIMIT 1) AS tahun_min,( SELECT bulan FROM pengembalian_view AS po WHERE po.id_ampra_gaji = pe.id_ampra_gaji AND po.id_tunjangan = pe.id_tunjangan ORDER BY po.tahun DESC, po.bulan DESC LIMIT 1) AS bulan_max, ( SELECT tahun FROM pengembalian_view AS po WHERE po.id_ampra_gaji = pe.id_ampra_gaji AND po.id_tunjangan = pe.id_tunjangan ORDER BY po.tahun DESC, po.bulan DESC LIMIT 1 ) AS tahun_max, SUM( nilai ) AS total FROM pengembalian_view AS pe LEFT JOIN tunjangan AS tu ON tu.id_tunjangan = pe.id_tunjangan WHERE pe.id_ampra_gaji = '$id_ampra_gaji' GROUP BY pe.id_tunjangan");
        $pengembalian_tunjangan = [];
        foreach ($pengembalian as $key => $value) {
            $pengembalian_tunjangan[] = "<b>$value->nama</b>";
        }

        // pengembalian pokok (kartu gaji)
        $pengembalian_pokok = DB::select("SELECT ppv.id_ampra_gaji,( SELECT bulan FROM pengembalian_pokok_view AS po WHERE po.id_ampra_gaji = ppv.id_ampra_gaji ORDER BY po.tahun ASC, po.bulan ASC LIMIT 1) AS bulan_min,( SELECT tahun FROM pengembalian_pokok_view AS po WHERE po.id_ampra_gaji = ppv.id_ampra_gaji ORDER BY po.tahun ASC, po.bulan ASC LIMIT 1) AS tahun_min,( SELECT bulan FROM pengembalian_pokok_view AS po WHERE po.id_ampra_gaji = ppv.id_ampra_gaji ORDER BY po.tahun DESC, po.bulan DESC LIMIT 1) AS bulan_max, ( SELECT tahun FROM pengembalian_pokok_view AS po WHERE po.id_ampra_gaji = ppv.id_ampra_gaji ORDER BY po.tahun DESC, po.bulan DESC LIMIT 1 ) AS tahun_max FROM pengembalian_pokok_view AS ppv WHERE ppv.id_ampra_gaji = '$id_ampra_gaji' GROUP BY ppv.id_ampra_gaji");
        if (count($pengembalian_pokok) > 0) {
            $pengembalian_kartu_gaji = ($pengembalian_pokok[0]->bulan_min === $pengembalian_pokok[0]->bulan_max && $pengembalian_pokok[0]->tahun_min === $pengembalian_pokok[0]->tahun_max) ? get_bulan($pengembalian_pokok[0]->bulan_min) . " " . $pengembalian_pokok[0]->tahun_min : get_bulan($pengembalian_pokok[0]->bulan_min) . " " . $pengembalian_pokok[0]->tahun_min . " s.d " . get_bulan($pengembalian_pokok[0]->bulan_max) . " " . $pengembalian_pokok[0]->tahun_max;
        } else {
            $pengembalian_kartu_gaji = "";
        }

        // jenis gaji
        $get_jenis_gaji = DB::select("SELECT kg.id_jenis_gaji, jg.nama, tahun FROM kartu_gaji AS kg LEFT JOIN jenis_gaji AS jg ON jg.id_jenis_gaji = kg.id_jenis_gaji WHERE kg.id_ampra_gaji = '$id_ampra_gaji' AND kg.id_jenis_gaji != '1' GROUP BY kg.id_jenis_gaji, jg.nama, tahun");
        $jenis_gaji = [];
        foreach ($get_jenis_gaji as $key => $value) {
            $jenis_gaji[] = "{$value->nama} {$value->tahun}";
        }

        // pengembalian pegawai anggota
        $get_pengembalian_anggota = DB::select("SELECT pa.nama FROM pengembalian AS pe LEFT JOIN pegawai_anggota AS pa ON pa.id_pegawai_anggota = pe.id_pegawai_anggota WHERE pe.id_ampra_gaji = '$id_ampra_gaji' GROUP BY pe.id_pegawai_anggota");
        $pengembalian_anggota = [];
        foreach ($get_pengembalian_anggota as $key => $value) {
            $pengembalian_anggota[] = "<b>$value->nama</b>";
        }

        $data = [
            'title'                   => 'SKPP',
            'pegawai'                 => $pegawai,
            'pegawai_anggota'         => $pegawai_anggota,
            'ttd'                     => $ttd,
            'ampra_gaji_tunjangan'    => $ampra_gaji_tunjangan,
            'ampra_gaji_potongan'     => $ampra_gaji_potongan,
            'kartu_gaji_tunjangan'    => $kartu_gaji_tunjangan,
            'kartu_gaji_potongan'     => $kartu_gaji_potongan,
            'total_tunjangan'         => $total_tunjangan[0]->nilai,
            'pengembalian'            => $pengembalian,
            'pengembalian_anggota'    => $pengembalian_anggota,
            'pengembalian_tunjangan'  => $pengembalian_tunjangan,
            'pengembalian_kartu_gaji' => $pengembalian_kartu_gaji,
            'jenis_gaji'              => $jenis_gaji,
        ];

        Pdf::printPdf('SKPP', 'admin.kartu_gaji.print', '', '', $data);
    }

    public function tunjangan($any)
    {
        $id_ampra_gaji = my_decrypt($any);

        $tunjangan = Tunjangan::all();

        $data = [
            'id_ampra_gaji' => $id_ampra_gaji,
            'tunjangan'     => $tunjangan
        ];

        return view('admin.kartu_gaji.tunjangan', $data);
    }

    public function potongan($any)
    {
        $id_ampra_gaji = my_decrypt($any);

        $id_users = $this->session['id_users'];

        $potongan = DB::select("SELECT p.id_potongan, p.nama, p.persen, tkgp.total FROM potongan AS p LEFT JOIN( SELECT pt.id_potongan, SUM( tkgt.nilai) AS total FROM potongan_tunjangan AS pt RIGHT JOIN t_kartu_gaji_tunjangan AS tkgt ON tkgt.id_tunjangan = pt.id_tunjangan WHERE tkgt.by_users = '$id_users' GROUP BY pt.id_potongan) AS tkgp ON tkgp.id_potongan = p.id_potongan");

        $data = [
            'id_ampra_gaji' => $id_ampra_gaji,
            'potongan'      => $potongan
        ];

        return view('admin.kartu_gaji.potongan', $data);
    }

    public function get_data_dt($any)
    {
        $id_ampra_gaji = my_decrypt($any);

        $data = KartuGaji::with(['toJenisGaji'])->where('kartu_gaji.id_ampra_gaji', '=', $id_ampra_gaji)->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin.kartu_gaji.det', ['id' => my_encrypt($row->id_ampra_gaji), 'any' => my_encrypt($row->id_kartu_gaji)]) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_kartu_gaji) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                ';
            })
            ->make(true);
    }

    public function save(Request $request)
    {
        try {
            $tahap = $request->tahap;

            if ($tahap === 'tunjangan') {
                // tunjangan

                $id_tunjangan = $request->id_tunjangan;
                $nilai        = $request->nilai;

                for ($i = 0; $i < count($id_tunjangan); $i++) {
                    $ampra_gaji_tunjangan[] = [
                        'id_tunjangan'  => $id_tunjangan[$i],
                        'nilai'         => remove_separator($nilai[$i]),
                        'by_users'      => $this->session['id_users'],
                    ];
                }

                TKartuGajiTunjangan::insert($ampra_gaji_tunjangan);

                $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
            } else {
                // potongan

                $id_ampra_gaji = $request->id_ampra_gaji;
                $id_jenis_gaji = $request->id_jenis_gaji;
                $awal_bulan    = $request->awal_bulan . '-01';
                $akhir_bulan   = $request->akhir_bulan . '-01';

                $start = strtotime($awal_bulan);
                $end   = strtotime($akhir_bulan);

                while ($start <= $end) {
                    $kartu_gaji = new KartuGaji();

                    $kartu_gaji->id_ampra_gaji = $id_ampra_gaji;
                    $kartu_gaji->id_jenis_gaji = $id_jenis_gaji;
                    $kartu_gaji->bulan         = date('m', $start);
                    $kartu_gaji->tahun         = date('Y', $start);
                    $kartu_gaji->by_users      = $this->session['id_users'];

                    $kartu_gaji->save();

                    // kartu gaji tunjangan
                    $t_kartu_gaji_tunjangan = TKartuGajiTunjangan::where('by_users', '=', $this->session['id_users'])->get();

                    foreach ($t_kartu_gaji_tunjangan as $key => $value) {
                        $kartu_gaji_tunjangan = new KartuGajiTunjangan();
                        $kartu_gaji_tunjangan->id_kartu_gaji = $kartu_gaji->id_kartu_gaji;
                        $kartu_gaji_tunjangan->id_tunjangan  = $value->id_tunjangan;
                        $kartu_gaji_tunjangan->nilai         = $value->nilai;
                        $kartu_gaji_tunjangan->by_users      = $this->session['id_users'];

                        $kartu_gaji_tunjangan->save();
                    }

                    // kartu gaji potongan

                    $id_potongan = $request->id_potongan;
                    $nilai       = $request->nilai;

                    for ($i = 0; $i < count($id_potongan); $i++) {
                        $kartu_gaji_potong = new KartuGajiPotongan();
                        $kartu_gaji_potong->id_kartu_gaji = $kartu_gaji->id_kartu_gaji;
                        $kartu_gaji_potong->id_potongan   = $id_potongan[$i];
                        $kartu_gaji_potong->nilai         = remove_separator($nilai[$i]);
                        $kartu_gaji_potong->by_users      = $this->session['id_users'];

                        $kartu_gaji_potong->save();
                    }

                    $start = strtotime("+1 month", $start);
                }

                TKartuGajiTunjangan::truncate();

                $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
            }
        } catch (\Exception $e) {
            $response = ['status' => false, 'title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }

    public function del(Request $request)
    {
        try {
            $kartu_gaji = KartuGaji::find(my_decrypt($request->id));

            $kartu_gaji->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
