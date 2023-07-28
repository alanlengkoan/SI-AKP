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
                        {{ Breadcrumbs::render('admin.jenis_gaji') }}
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
                            <button type="button" id="add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tabel-jenis-gaji-dt" style="width: 100%;">
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: body -->
    </div>
</div>

<!-- begin:: modal tambah & ubah -->
<div id="modal-add-upd" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
            </div>
            <form id="form-add-upd" action="{{ route('admin.jenis_gaji.save') }}" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="id_jenis_gaji" id="id_jenis_gaji" />
                <!-- end:: id -->

                <div class="modal-body">
                    <!-- begin:: untuk loading -->
                    <div id="form-loading"></div>
                    <!-- end:: untuk loading -->
                    <!-- begin:: untuk form -->
                    <div id="form-show">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama&nbsp;*</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama gaji" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                    </div>
                    <!-- end:: untuk form -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancel" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" id="save" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end:: modal tambah & ubah -->
@endsection
<!-- end:: content -->

<!-- begin:: js local -->
@section('js')
<script type="text/javascript" src="{{ asset_admin('my_assets/datatables/1.11.3/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset_admin('my_assets/datatables/1.11.3/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset_admin('my_assets/datatables-responsive/2.2.9/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset_admin('my_assets/parsley/2.9.2/parsley.js') }}"></script>

<script>
    var table;

    let untukTabel = function() {
        table = $('#tabel-jenis-gaji-dt').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: "{{ route('admin.jenis_gaji.get_data_dt') }}",
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
                    title: 'Aksi',
                    data: null,
                    className: 'text-center',
                    responsivePriority: -1,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, full, meta) {
                        return `
                            <button type="button" id="upd" data-id="` + full.id_jenis_gaji + `" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i>&nbsp;Ubah</button>&nbsp;
                            <button type="button" id="del" data-id="` + full.id_jenis_gaji + `" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        `;
                    },
                },
            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }, ],
        });
    }();

    let untukSimpanData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();

            $('#nama').attr('required', 'required');

            var parsleyConfig = {
                errorsContainer: function(parsleyField) {
                    var $err = parsleyField.$element.siblings('.errorInput');
                    return $err;
                }
            };

            $("#form-add-upd").parsley(parsleyConfig);

            if ($('#form-add-upd').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#save').attr('disabled', 'disabled');
                        $('#save').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        swal({
                            title: response.title,
                            text: response.text,
                            icon: response.type,
                            button: response.button,
                        }).then((value) => {
                            $('#modal-add-upd').modal('hide');
                            table.ajax.reload();
                        });

                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            }
        });
    }();

    let untukTambahData = function() {
        $(document).on('click', '#add', function(e) {
            e.preventDefault();
            $('#judul-add-upd').text('Tambah');
            $('#id_jenis_gaji').removeAttr('value');

            $('#form-add-upd').parsley().reset();
            $('#form-add-upd')[0].reset();
        });
    }();

    let untukUbahData = function() {
        $(document).on('click', '#upd', function(e) {
            var ini = $(this);
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "{{ route('admin.jenis_gaji.get') }}",
                data: {
                    id: ini.data('id')
                },
                beforeSend: function() {
                    $('#judul-add-upd').html('Ubah');
                    $('#form-loading').html(`<div class="center"><div class="loader"></div></div>`);
                    $('#form-show').attr('style', 'display: none');

                    ini.attr('disabled', 'disabled');
                    ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                },
                success: function(response) {
                    $('#form-loading').empty();
                    $('#form-show').removeAttr('style');

                    $('#id_jenis_gaji').val(response.id_jenis_gaji);
                    $('#nama').val(response.nama);

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-edit"></i>&nbsp;Ubah');
                }
            });
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
                        url: "{{ route('admin.jenis_gaji.del') }}",
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