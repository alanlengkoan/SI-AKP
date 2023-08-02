<!-- begin:: base -->
@extends('camat/base')
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
                                {{ $pegawai->toUsers->nama }}
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
                            <label class="col-sm-4 font-weight-bolder">Masa Kerja Golongan</label>
                            <div class="col-sm-8">
                                {{ $mkg }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 font-weight-bolder">Gaji Pokok</label>
                            <div class="col-sm-8">
                                {{ rupiah($gapok->gaji ?? 0) }}
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
    </div>
</div>
@endsection
<!-- end:: content -->

<!-- begin:: js local -->
@section('js')
@endsection
<!-- end:: js local -->