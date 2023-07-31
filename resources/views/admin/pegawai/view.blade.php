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
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
                <div class="card-header-right">
                    <button type="button" id="add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills bg-white" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="aktif-tab" data-toggle="tab" href="#aktif" role="tab" aria-controls="aktif" aria-selected="true">
                            Aktif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="pensiun-tab" data-toggle="tab" href="#pensiun" role="tab" aria-controls="pensiun" aria-selected="true">
                            Pensiun
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="myTabContent">
                    <!-- begin:: aktif -->
                    <div class="tab-pane fade show active" id="aktif" role="tabpanel" aria-labelledby="aktif-tab">
                        <table class="table table-striped table-bordered" id="tabel-pegawai-aktif-dt" style="width: 100%;"></table>
                    </div>
                    <!-- end:: aktif -->
                    <!-- begin:: pensiun -->
                    <div class="tab-pane fade" id="pensiun" role="tabpanel" aria-labelledby="pensiun-tab">
                        <table class="table table-striped table-bordered" id="tabel-pegawai-pensiun-dt" style="width: 100%;"></table>
                    </div>
                    <!-- end:: pensiun -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- begin:: modal tambah & ubah -->
<div id="modal-add-upd" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd"></span> <?= $title ?></h4>
            </div>
            <form id="form-add-upd" action="{{ route('admin.pegawai.save') }}" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="id_pegawai" id="id_pegawai" />
                <!-- end:: id -->

                <div class="modal-body">
                    <!-- begin:: untuk loading -->
                    <div id="form-loading"></div>
                    <!-- end:: untuk loading -->
                    <!-- begin:: untuk form -->
                    <div id="form-show">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIP&nbsp;*</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan nip pegawai" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama&nbsp;*</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama pegawai" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jenis Kelamin&nbsp;*</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kelamin" id="kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tempat Lahir&nbsp;*</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" placeholder="Masukkan tempat lahir pegawai" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal Lahir&nbsp;*</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal SK&nbsp;*</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="tgl_sk" id="tgl_sk" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Agama&nbsp;*</label>
                            <div class="col-sm-10">
                                <select name="id_agama" id="id_agama">
                                    <option value=""></option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jabatan&nbsp;*</label>
                            <div class="col-sm-10">
                                <select name="id_jabatan" id="id_jabatan">
                                    <option value=""></option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pangkat&nbsp;*</label>
                            <div class="col-sm-10">
                                <select name="id_pangkat" id="id_pangkat">
                                    <option value=""></option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Pendidikan&nbsp;*</label>
                            <div class="col-sm-10">
                                <select name="id_pendidikan" id="id_pendidikan">
                                    <option value=""></option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status&nbsp;*</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="status" id="status">
                                    <option value="">Pilih Status</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Pensiun</option>
                                </select>
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
<script type="text/javascript" src="{{ asset_admin('js/plugins/select2.full.min.js') }}"></script>

<script>
    var tablePegawaiAktif;
    var tablePegawaiPensiun;

    let untukTabel = function() {
        tablePegawaiAktif = $('#tabel-pegawai-aktif-dt').DataTable({
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
                url: "{{ route('admin.pegawai.get_data_dt') }}",
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
                    title: 'Tgl SK',
                    data: 'tgl_sk',
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

        tablePegawaiPensiun = $('#tabel-pegawai-pensiun-dt').DataTable({
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
                url: "{{ route('admin.pegawai.get_data_dt') }}",
                type: "post",
                data: function(d) {
                    d._token = "{{ csrf_token() }}";
                    d.status = '0';
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
                    title: 'Tgl SK',
                    data: 'tgl_sk',
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

    let untukSimpanData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();

            $('#nip').attr('required', 'required').attr('data-parsley-error-message', 'NIP harus diisi');
            $('#nama').attr('required', 'required').attr('data-parsley-error-message', 'Nama harus diisi');
            $('#kelamin').attr('required', 'required').attr('data-parsley-error-message', 'Jenis kelamin harus diisi');
            $('#tmp_lahir').attr('required', 'required').attr('data-parsley-error-message', 'Tempat lahir harus diisi');
            $('#tgl_lahir').attr('required', 'required').attr('data-parsley-error-message', 'Tanggal lahir harus diisi');
            $('#tgl_sk').attr('required', 'required').attr('data-parsley-error-message', 'Tanggal SK harus diisi');
            $('#id_agama').attr('required', 'required').attr('data-parsley-error-message', 'Agama harus dipilih');
            $('#id_pangkat').attr('required', 'required').attr('data-parsley-error-message', 'Pangkat harus dipilih');
            $('#id_pendidikan').attr('required', 'required').attr('data-parsley-error-message', 'Pendidikan harus dipilih');
            $('#status').attr('required', 'required').attr('data-parsley-error-message', 'Status harus dipilih');

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
                            tablePegawaiAktif.ajax.reload();
                            tablePegawaiPensiun.ajax.reload();
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

            $('#id_pegawai').removeAttr('value');
            $('#id_agama').val('').trigger('change');
            $('#id_pangkat').val('').trigger('change');
            $('#id_pendidikan').val('').trigger('change');

            $('#form-add-upd').parsley().reset();
            $('#form-add-upd')[0].reset();
        });
    }();

    let untukUbahData = function() {
        $(document).on('click', '#upd', function(e) {
            var ini = $(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "{{ route('admin.pegawai.show') }}",
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

                    $('#id_pegawai').val(response.id_pegawai);
                    $('#nip').val(response.nip);
                    $('#nama').val(response.nama);
                    $('#kelamin').val(response.kelamin);
                    $('#tmp_lahir').val(response.tmp_lahir);
                    $('#tgl_lahir').val(response.tgl_lahir);
                    $('#tgl_sk').val(response.tgl_sk);
                    $('#id_agama').val(response.id_agama).trigger('change');
                    $('#id_pangkat').val(response.id_pangkat).trigger('change');
                    $('#id_pendidikan').val(response.id_pendidikan).trigger('change');
                    $('#status').val(response.status);

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
                        url: "{{ route('admin.pegawai.del') }}",
                        dataType: 'json',
                        data: {
                            id: ini.data('id'),
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
                                tablePegawaiAktif.ajax.reload();
                                tablePegawaiPensiun.ajax.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();

    let untukSelectAgama = function() {
        $.get("{{ route('admin.agama.get_all') }}", function(response) {
            $("#id_agama").select2({
                placeholder: "Pilih Agama",
                dropdownParent: $('#modal-add-upd'),
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectJabatan = function() {
        $.get("{{ route('admin.jabatan.get_all') }}", function(response) {
            $("#id_jabatan").select2({
                placeholder: "Pilih Jabatan",
                dropdownParent: $('#modal-add-upd'),
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectPangkat = function() {
        $.get("{{ route('admin.pangkat.get_all') }}", function(response) {
            $("#id_pangkat").select2({
                placeholder: "Pilih Pangkat",
                dropdownParent: $('#modal-add-upd'),
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectPendidikan = function() {
        $.get("{{ route('admin.pendidikan.get_all') }}", function(response) {
            $("#id_pendidikan").select2({
                placeholder: "Pilih Pendidikan",
                dropdownParent: $('#modal-add-upd'),
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();
</script>
@endsection
<!-- end:: js local -->