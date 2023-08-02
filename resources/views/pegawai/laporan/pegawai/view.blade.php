<!-- begin:: base -->
@extends('pegawai/base')
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
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="tabel-pegawai-aktif-dt" style="width: 100%;">
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
<script type="text/javascript" src="{{ asset_admin('my_assets/parsley/2.9.2/parsley.js') }}"></script>
<script type="text/javascript" src="{{ asset_admin('js/plugins/select2.full.min.js') }}"></script>

<script>
    var table;

    let untukTabel = function() {
        table = $('#tabel-pegawai-aktif-dt').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            autoWidth: false,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: {
                url: "{{ route('pegawai.laporan.pegawai.get_data_dt') }}",
                type: "post",
                data: function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.status = '1';
                }
            },
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
                    title: 'Jenis Kelamin',
                    data: 'kelamin',
                    class: 'text-center'
                },
                {
                    title: 'Tempat Lahir',
                    data: 'tmp_lahir',
                    class: 'text-center'
                },
                {
                    title: 'Tgl Lahir',
                    data: 'tgl_lahir',
                    class: 'text-center'
                },
                {
                    title: 'Tgl Mulai Tugas',
                    data: 'tmt',
                    class: 'text-center'
                },
                {
                    title: 'Agama',
                    data: 'agama',
                    class: 'text-center'
                },
                {
                    title: 'Jabatan',
                    data: 'jabatan',
                    class: 'text-center'
                },
                {
                    title: 'Pangkat',
                    data: 'pangkat',
                    class: 'text-center'
                },
                {
                    title: 'Pendidikan',
                    data: 'pendidikan',
                    class: 'text-center'
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