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
                        {{ Breadcrumbs::render('admin.ampra_gaji') }}
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
                        <div class="card-header-right">
                            <a href="{{ route('admin.ampra_gaji.add') }}" id="add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;Tambah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tabel-pegawai-ampra-gaji-dt" style="width: 100%;">
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
        table = $('#tabel-pegawai-ampra-gaji-dt').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: "{{ route('admin.ampra_gaji.get_data_dt') }}",
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

    let untukHapusData = function() {
        $(document).on('click', '#del', function() {
            var ini = $(this);

            swal({
                title: "Apakah Anda yakin ingin menghapusnya?",
                text: "Data yang telah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.ampra_gaji.del') }}",
                        dataType: 'json',
                        data: {
                            id: ini.data('id'),
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                        },
                        success: function(response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                table.ajax.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();
</script>
@endsection
<!-- end:: js local -->