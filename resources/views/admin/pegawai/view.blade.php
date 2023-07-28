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
                        {{ Breadcrumbs::render('admin.pegawai') }}
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
                        <table class="table table-striped table-bordered" id="tabel-pegawai-dt" style="width: 100%;">
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

<script>
    var table;

    let untukTabel = function() {
        table = $('#tabel-pegawai-dt').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: "{{ route('admin.pegawai.get_data_dt') }}",
            columns: [{
                    title: 'No.',
                    data: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    title: 'NIP',
                    data: 'nip',
                    class: 'text-center'
                },
                {
                    title: 'Nama',
                    data: 'nama',
                    class: 'text-center'
                },
                {
                    title: 'Jabatan',
                    data: 'to_jabatan.nama',
                    class: 'text-center'
                },
                {
                    title: 'Pangkat',
                    data: 'to_pangkat.nama',
                    class: 'text-center'
                },
                {
                    title: 'Jenis SKPP',
                    data: 'to_jenis_skpp.nama',
                    class: 'text-center'
                },
                {
                    title: 'Asal Surat Keputusan',
                    data: 'to_asal_surat_keputusan.nama',
                    class: 'text-center'
                },
                {
                    title: 'Status Meninggal',
                    data: null,
                    class: 'text-center',
                    render: function(data, type, full, meta) {
                        return (full.status_meninggal === 'y' ? 'Ya' : 'Tidak');
                    },
                },
                {
                    title: 'Aksi',
                    data: 'action',
                    className: 'text-center',
                    responsivePriority: -1,
                    orderable: false,
                    searchable: false,
                },
            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }, ],
        });
    }();
</script>
@endsection
<!-- end:: js local -->