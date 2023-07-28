<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
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
                        {{ Breadcrumbs::render('admin.kartu_gaji.det', $ampra_gaji, $kartu_gaji) }}
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
                        <h5>{{ $title }} Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">NIP</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->nip }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Nama</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        {{ ($ampra_gaji->toPegawai->kelamin === 'l' ? 'Laki - laki' : 'Perempuan') }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Jenis SKPP</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->toJenisSkpp->nama }}
                                    </div>
                                </div>
                                @if($ampra_gaji->toPegawai->toJenisSkpp->kode === 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Lokasi Mutasi</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->mutasi }}
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Pangkat</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->toPangkat->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Jabatan</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->toJabatan->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Asal Surat Keputusan</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->toAsalSuratKeputusan->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">No. Surat Keputusan</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->no_asal_surat_keputusan }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Tgl. Surat Keputusan</label>
                                    <div class="col-sm-8">
                                        {{ tgl_indo($ampra_gaji->toPegawai->tgl_asal_surat_keputusan) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">No. SP2D</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->no_sp2d }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Tgl. SP2D</label>
                                    <div class="col-sm-8">
                                        {{ tgl_indo($ampra_gaji->toPegawai->tgl_sp2d) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Tempat Tugas</label>
                                    <div class="col-sm-8">
                                        {{ $ampra_gaji->toPegawai->tmp_tugas }}
                                    </div>
                                </div>
                                @if($ampra_gaji->toPegawai->toJenisSkpp->kode !== 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Gaji Pensiun Pokok</label>
                                    <div class="col-sm-8">
                                        Rp. {{ create_separator($ampra_gaji->toPegawai->gaji) }},-
                                    </div>
                                </div>
                                @endif
                                @if($ampra_gaji->toPegawai->toJenisSkpp->kode === 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">TMT Pindah</label>
                                    <div class="col-sm-8">
                                        {{ tgl_indo($ampra_gaji->toPegawai->tgl_pensiun) }}
                                    </div>
                                </div>
                                @else
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">TMT Pensiun</label>
                                    <div class="col-sm-8">
                                        {{ tgl_indo($ampra_gaji->toPegawai->tgl_pensiun) }}
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Gaji Terakhir di Bayarkan</label>
                                    <div class="col-sm-8">
                                        {{ get_bulan(date('m', strtotime($ampra_gaji->toPegawai->tgl_pelapor))) }} {{ date('Y', strtotime($ampra_gaji->toPegawai->tgl_pelapor)) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Status Menikah</label>
                                    <div class="col-sm-8">
                                        {{ ($ampra_gaji->toPegawai->status_menikah === 'y' ? 'Ya' : 'Tidak') }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 font-weight-bolder">Status Meninggal</label>
                                    <div class="col-sm-8">
                                        {{ ($ampra_gaji->toPegawai->status_meninggal === 'y' ? 'Ya' : 'Tidak') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <img src="{{ ($ampra_gaji->toPegawai->foto === null ? '//placehold.co/150' : asset_upload('picture/'.$ampra_gaji->toPegawai->foto)) }}" class="img-fluid" width="500" heigth="500" />
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $tunjangan = 0;
                $potongan = 0;
                @endphp
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ $title }} Tunjangan</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($kartu_gaji_tunjangan as $row)
                                @php
                                $tunjangan += $row->nilai;
                                @endphp
                                <div class="form-group row">
                                    <label class="col-sm-6 font-weight-bolder">{{ $row->toTunjangan->nama }}</label>
                                    <div class="col-sm-6">
                                        Rp. {{ create_separator($row->nilai) }}
                                    </div>
                                </div>
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-6 font-weight-bolder">Total Penghasilan Kotor</label>
                                    <div class="col-sm-6">
                                        Rp. {{ create_separator($tunjangan) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ $title }} Potongan</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($kartu_gaji_potongan as $row)
                                @php
                                $potongan += $row->nilai;
                                @endphp
                                <div class="form-group row">
                                    <label class="col-sm-6 font-weight-bolder">{{ $row->toPotongan->nama }}</label>
                                    <div class="col-sm-6">
                                        Rp. {{ create_separator($row->nilai) }}
                                    </div>
                                </div>
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-6 font-weight-bolder">Total Potongan</label>
                                    <div class="col-sm-6">
                                        Rp. {{ create_separator($potongan) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }} Total Bersih</h5>
                    </div>
                    <div class="card-body">
                        @php
                        $total_bersih = ($tunjangan - $potongan);
                        @endphp
                        <h4>Total Bersih : Rp. {{ create_separator($total_bersih) }}</h4>
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
<script>

</script>
@endsection
<!-- end:: js local -->