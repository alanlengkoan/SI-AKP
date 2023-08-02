<?php

namespace App\Http\Controllers\camat;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        // untuk deteksi session
        detect_role_session($this->session, $request->session()->has('roles'), 'camat');
    }

    public function pegawai()
    {
        return Template::load($this->session['roles'], 'Laporan Pegawai', 'laporan/pegawai', 'view');
    }

    public function pegawai_get_data_dt(Request $request)
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
                return '
                    <a href="' . route('camat.pegawai.det', my_encrypt($row->id_pegawai)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>&nbsp;
                ';
            })
            ->make(true);
    }

    public function pensiun()
    {
        return Template::load($this->session['roles'], 'Laporan Pegawai Pensiunan', 'laporan/pensiun', 'view');
    }

    public function pensiun_get_data_dt(Request $request)
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
                return '
                    <a href="' . route('camat.pegawai.det', my_encrypt($row->id_pegawai)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>&nbsp;
                ';
            })
            ->make(true);
    }

    public function pangkat()
    {
        return Template::load($this->session['roles'], 'Laporan Kenaikan Pangkat', 'laporan/pangkat', 'view');
    }

    public function pangkat_get_data_dt(Request $request)
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
                            <a href="' . route('camat.pegawai.print', my_encrypt($row->id_pegawai)) . '" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a>&nbsp;
                            <a href="' . route('camat.pegawai.det', my_encrypt($row->id_pegawai)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>
                        ';
                } else {
                    return '<a href="' . route('camat.pegawai.det', my_encrypt($row->id_pegawai)) . '" class="btn btn-info btn-sm"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>';
                }
            })
            ->make(true);
    }
}
