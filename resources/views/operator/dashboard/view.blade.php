<!-- begin:: base -->
@extends('operator/base')
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
                        {{ Breadcrumbs::render('operator.dashboard') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: body -->
        <div class="row">
            @foreach($jenis_skpp as $row)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h4 class="text-c-blue">{{ $row->total }}</h4>
                                <h6 class="text-muted m-b-0">{{ $row->nama }}</h6>
                            </div>
                            <div class="col-2 text-right">
                                <i class="feather icon-file f-28"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-c-blue">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <p class="text-white m-b-0">{{ $row->nama }}</p>
                            </div>
                            <div class="col-3 text-right">
                                <i class="feather icon-file text-white f-16"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Apa itu SIPAPA ?</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            Sistem Penata Layanan Pemberhentian Pembayaran Gaji Secara Online (SIPAPA) adalah aplikasi yang dapat memudahkan dan mengefesiensikan waktu pada pelayanan penerbitan Surat Keterangan Pemberhentian Pembayaran Gaji bagi ASN yang memasuki usia pensiun dan pegawai yang mutasi ke daerah lain serta ahli waris dari pegawai yang telah meninggal dunia.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Apa itu SKPP ?</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            Surat Keterangan Penghentian Pembayaran (SKPP) adalah surat keterangan tentang penghentian pembayaran gaji terhitung mulai bulan dihentikannya pembayarannya yang dibuat/diterbitkan oleh BPKPD atas pegawai yang pindah atau pensiun berdasarkan surat keterangan yang diterbitkan oleh BKN atau pemerintah provinsi/kota dan/atau kabupaten setempat bahwa record pegawai tersebut dalam database pegawai telah dipindahkan ke dalam tabel pegawai nonaktif.
                        </p>
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
@endsection
<!-- end:: js local -->