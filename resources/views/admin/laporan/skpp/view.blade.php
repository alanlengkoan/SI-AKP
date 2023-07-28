<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables/1.11.3/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables-responsive/2.2.9/css/responsive.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset_admin('css/plugins/select2.min.css') }}" />
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
                        {{ Breadcrumbs::render('admin.laporan.skpp') }}
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
                        <h5>Form {{ $title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label font-weight-bolder">Bulan&nbsp;*</label>
                            <div class="col-sm-10">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option value=""></option>
                                    @foreach ($bulan as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label font-weight-bolder">Tahun&nbsp;*</label>
                            <div class="col-sm-10">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value=""></option>
                                    @foreach ($tahun as $key => $val)
                                    <option value="{{ $val }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tabel-laporan-skpp-dt" style="width: 100%;">
                        </table>
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
<script type="text/javascript" src="{{ asset_admin('js/plugins/select2.full.min.js') }}"></script>

<script>
    var table;

    let untukTabel = function() {
        table = $('#tabel-laporan-skpp-dt').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: {
                url: "{{ route('admin.laporan.get_data_skpp_dt') }}",
                type: "GET",
                data: {
                    bulan: function() {
                        return $('#bulan').val()
                    },
                    tahun: function() {
                        return $('#tahun').val()
                    },
                }
            },
            columns: [{
                    title: 'No.',
                    data: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    title: 'Nomor Surat',
                    data: 'no_surat',
                    class: 'text-center'
                },
                {
                    title: 'Tanggal Surat',
                    data: null,
                    class: 'text-center',
                    render: function(data, type, full, meta) {
                        return tglIndo(data.tgl_surat);
                    },
                },
                {
                    title: 'NIP',
                    data: 'to_pegawai.nip',
                    class: 'text-center'
                },
                {
                    title: 'Nama',
                    data: 'to_pegawai.nama',
                    class: 'text-center'
                },
                {
                    title: 'Jenis SKPP',
                    data: 'to_pegawai.to_jenis_skpp.nama',
                    class: 'text-center'
                },
            ],
        });

        $("#bulan").change(function() {
            table.ajax.reload();
        });
        $("#tahun").change(function() {
            table.ajax.reload();
        });
    }();

    let untukSelectBulan = function() {
        $("#bulan").select2({
            placeholder: "Pilih Bulan",
            width: '100%',
            allowClear: true,
        });
    }();

    let untukSelectTahun = function() {
        $("#tahun").select2({
            placeholder: "Pilih Tahun",
            width: '100%',
            allowClear: true,
        });
    }();
</script>
@endsection
<!-- end:: js local -->