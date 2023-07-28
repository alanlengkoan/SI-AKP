<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Pegawai;
use App\Models\PegawaiBerkas;
use Illuminate\Http\Request;
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
        $pegawai = Pegawai::find($id_pegawai);

        // berkas pegawai
        $pegawai_berkas = PegawaiBerkas::with(['toBerkasSkpp'])->where('pegawai_berkas.id_pegawai', '=', $id_pegawai)->orderBy('pegawai_berkas.id_pegawai_berkas', 'asc')->get();

        $data = [
            'pegawai'        => $pegawai,
            'pegawai_berkas' => $pegawai_berkas,
        ];

        return Template::load($this->session['roles'], 'Detail Pegawai', 'pegawai', 'det', $data);
    }

    public function get_data_dt()
    {
        $data = Pegawai::with(['toJabatan', 'toPangkat', 'toJenisSkpp', 'toAsalSuratKeputusan'])->orderBy('id_pegawai', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a href="' . route('admin.pegawai.det', my_encrypt($row->id_pegawai)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>';
            })
            ->make(true);
    }

    public function get_all()
    {
        $get = Pegawai::select('id_pegawai', 'nip', 'nama')->where('status_skpp', '=', '0')->orderBy('nip', 'desc')->get();

        $response = [];

        foreach ($get as $value) {
            $response[] = [
                'id'   => $value->id_pegawai,
                'text' => $value->nip . ' | ' . $value->nama,
            ];
        }

        return response()->json($response);
    }
}
