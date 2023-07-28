<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\AmpraGaji;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengembalianController extends Controller
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

        return Template::load($this->session['roles'], 'Pengembalian', 'pengembalian', 'view', $data);
    }

    public function get_data_dt($any)
    {
        $id_ampra_gaji = my_decrypt($any);

        $data = Pengembalian::with(['toPegawaiAnggota', 'toJenisGaji', 'toTunjangan'])->where('pengembalian.id_ampra_gaji', '=', $id_ampra_gaji)->orderBy('id_pengembalian', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_pengembalian) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                ';
            })
            ->make(true);
    }

    public function save(Request $request)
    {
        try {
            $awal_bulan    = $request->awal_bulan . '-01';
            $akhir_bulan   = $request->akhir_bulan . '-01';

            $start = strtotime($awal_bulan);
            $end   = strtotime($akhir_bulan);

            while ($start <= $end) {
                $pengembalian = new Pengembalian();

                $pengembalian->id_ampra_gaji      = $request->id_ampra_gaji;
                $pengembalian->id_pegawai_anggota = $request->id_pegawai_anggota;
                $pengembalian->id_jenis_gaji      = $request->id_jenis_gaji;
                $pengembalian->id_tunjangan       = $request->id_tunjangan;
                $pengembalian->bulan              = date('m', $start);
                $pengembalian->tahun              = date('Y', $start);
                $pengembalian->nilai              = remove_separator($request->nilai);
                $pengembalian->by_users           = $this->session['id_users'];

                $pengembalian->save();

                $start = strtotime("+1 month", $start);
            }

            $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Data Sukses di Proses!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }

    public function del(Request $request)
    {
        try {
            $pengembalian = Pengembalian::find(my_decrypt($request->id));

            $pengembalian->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Proses!', 'type' => 'error', 'button' => 'Ok!'];
        }

        return response()->json($response);
    }
}
