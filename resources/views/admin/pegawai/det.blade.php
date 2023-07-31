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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
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
                            <label class="col-sm-4 font-weight-bolder">Tempat Lahir</label>
                            <div class="col-sm-8">
                                {{ $pegawai->tmp_lahir }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 font-weight-bolder">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                {{ tgl_indo($pegawai->tgl_lahir) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 font-weight-bolder">Tanggal Mulai Tugas</label>
                            <div class="col-sm-8">
                                {{ tgl_indo($pegawai->tmt) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 font-weight-bolder">Agama</label>
                            <div class="col-sm-8">
                                {{ $pegawai->toAgama->nama }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 font-weight-bolder">Jabatan</label>
                            <div class="col-sm-8">
                                {{ $pegawai->toJabatan->nama }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 font-weight-bolder">Pangkat</label>
                            <div class="col-sm-8">
                                {{ $pegawai->toPangkat->nama }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 font-weight-bolder">Pendidikan</label>
                            <div class="col-sm-8">
                                {{ $pegawai->toPendidikan->nama }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 font-weight-bolder">Status</label>
                            <div class="col-sm-8">
                                {{ ($pegawai->nip == '0' ? 'Pensiun' : 'Aktif') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Riwayat Pangkat Pegawai</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="tabel-pegawai_pangkat-dt" style="width: 100%;">
                </table>
            </div>
        </div>
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
    var tablePegawaiPangkat;

    let untukTable = function() {
        tablePegawaiAnggota = $('#tabel-pegawai_pangkat-dt').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: {
                url: "{{ route('admin.pegawai.pangkat.get_data_dt') }}",
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
                    title: 'Pegawai',
                    data: 'pegawai',
                    class: 'text-center'
                },
                {
                    title: 'Pangkat',
                    data: 'pangkat',
                    class: 'text-center'
                },
                {
                    title: 'Tgl Mulai Tugas',
                    data: 'tmt',
                    class: 'text-center'
                },
            ],
        });
    }();
</script>
@endsection
<!-- end:: js local -->