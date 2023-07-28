<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables/1.11.3/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables-responsive/2.2.9/css/responsive.dataTables.min.css') }}" />
@endsection
<!-- end:: css local -->

<!-- begin:: content -->
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- begin:: breadcrumb -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">{{ $title }}</h5>
                        </div>
                        {{ Breadcrumbs::render('admin.pegawai.det', $pegawai) }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">NIP</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->nip }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Nama</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        {{ ($pegawai->kelamin === 'l' ? 'Laki - laki' : 'Perempuan') }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Jenis SKPP</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->toJenisSkpp->nama }}
                                    </div>
                                </div>
                                @if($pegawai->toJenisSkpp->kode === 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Lokasi Mutasi</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->mutasi }}
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Pangkat</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->toPangkat->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Jabatan</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->toJabatan->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Asal Surat Keputusan</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->toAsalSuratKeputusan->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">No. Surat Keputusan</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->no_asal_surat_keputusan }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Tgl. Surat Keputusan</label>
                                    <div class="col-sm-8">
                                        {{ tgl_indo($pegawai->tgl_asal_surat_keputusan) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">No. SP2D</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->no_sp2d }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Tgl. SP2D</label>
                                    <div class="col-sm-8">
                                        {{ tgl_indo($pegawai->tgl_sp2d) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Tempat Tugas</label>
                                    <div class="col-sm-8">
                                        {{ $pegawai->tmp_tugas }}
                                    </div>
                                </div>
                                @if($pegawai->toJenisSkpp->kode !== 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Gaji Pensiun Pokok</label>
                                    <div class="col-sm-8">
                                        Rp. {{ create_separator($pegawai->gaji) }},-
                                    </div>
                                </div>
                                @endif
                                @if($pegawai->toJenisSkpp->kode === 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">TMT Pindah</label>
                                    <div class="col-sm-8">
                                        {{ tgl_indo($pegawai->tgl_pensiun) }}
                                    </div>
                                </div>
                                @else
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">TMT Pensiun</label>
                                    <div class="col-sm-8">
                                        {{ tgl_indo($pegawai->tgl_pensiun) }}
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Gaji Terakhir di Bayarkan</label>
                                    <div class="col-sm-8">
                                        {{ get_bulan(date('m', strtotime($pegawai->tgl_pelapor))) }} {{ date('Y', strtotime($pegawai->tgl_pelapor)) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Status Menikah</label>
                                    <div class="col-sm-8">
                                        {{ ($pegawai->status_menikah === 'y' ? 'Ya' : 'Tidak') }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Status Meninggal</label>
                                    <div class="col-sm-8">
                                        {{ ($pegawai->status_meninggal === 'y' ? 'Ya' : 'Tidak') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ ($pegawai->foto === null ? '//placehold.co/150' : asset_upload('picture/'.$pegawai->foto)) }}" class="img-fluid" width="500" heigth="500" />
                            </div>
                        </div>
                    </div>
                </div>
                @if($pegawai->status_menikah === 'y')
                <div class="card">
                    <div class="card-header">
                        <h5>Anggota Keluarga Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tabel-pegawai-anggota-dt" style="width: 100%;">
                        </table>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h5>Berkas Pegawai</h5>
                    </div>
                    <div class="card-body">
                        @if(count($pegawai_berkas) !== 0)
                        @foreach ($pegawai_berkas as $row)
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">{{ $row->toBerkasSkpp->nama }}</label>
                            <div class="col-sm-6">
                                @if (get_extension($row->file) == 'pdf')
                                <embed style="height: 500px;" src="{{ asset_upload('doc/' . $row->file) }}" type="application/pdf" frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
                                @else
                                <img style="padding-bottom: 10px" src="{{ ($row->file === null ? '//placehold.co/150' : asset_upload('picture/'.$row->file)) }}" class="img-fluid" width="500" heigth="500" />
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Perhatian!</h4>
                            <p>Pegawai belum mengupload berkas.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: body -->
    </div>
</div>
@endsection
<!-- end:: content -->

<!-- begin:: js local -->
@section('js')
<script type="text/javascript" src="{{ asset_admin('my_assets/datatables/1.11.3/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset_admin('my_assets/datatables/1.11.3/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset_admin('my_assets/datatables-responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>

<script>
    var tablePegawaiAnggota;

    let untukTabelAnggotaPegawai = function() {
        tablePegawaiAnggota = $('#tabel-pegawai-anggota-dt').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: {
                url: "{{ route('admin.pegawai.anggota.get_data_dt') }}",
                type: 'GET',
                data: {
                    id_pegawai: '{{ $pegawai->id_pegawai }}'
                }
            },
            columns: [{
                    title: 'No.',
                    data: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    class: 'text-center'
                },
                {
                    title: 'Jenis Anggota Keluarga',
                    data: 'to_jenis_anggota.nama',
                    class: 'text-center'
                },
                {
                    title: 'Jenis Kelamin',
                    data: null,
                    class: 'text-center',
                    render: function(data, type, full, meta) {
                        return (full.kelamin === 'l' ? 'Laki - laki' : 'Perempuan');
                    },
                },
                {
                    title: 'Tanggal Lahir',
                    data: null,
                    class: 'text-center',
                    render: function(data, type, full, meta) {
                        return tglIndo(full.tgl_lahir);
                    },
                },
                {
                    title: 'Tempat Lahir',
                    data: 'tmp_lahir',
                    class: 'text-center'
                },
                {
                    title: 'Status Tanggungan',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return (full.status_tanggungan === 'y' ? '<span class="badge badge-success">Ya</span>' : '<span class="badge badge-danger">Tidak</span>');
                    },
                },
                {
                    title: 'Catatan',
                    data: 'keterangan',
                    class: 'text-center'
                },
            ],
        });
    }();
</script>
@endsection
<!-- end:: js local -->