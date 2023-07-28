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
                        {{ Breadcrumbs::render('admin.pengembalian', $ampra_gaji) }}
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
                        <h5>Detail {{ $title }}</h5>
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
                <div class="card">
                    <div class="card-header">
                        <h5>Daftar {{ $title }}</h5>
                        <div class="card-header-right">
                            <button type="button" id="add" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add-upd" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tabel-pengembalian-dt" style="width: 100%;">
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
            <form id="form-add-upd" action="{{ route('admin.pengembalian.save') }}" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="id_ampra_gaji" id="id_ampra_gaji" value="{{ $ampra_gaji->id_ampra_gaji }}" />
                <!-- end:: id -->

                <div class="modal-body">
                    <!-- begin:: untuk loading -->
                    <div id="form-loading"></div>
                    <!-- end:: untuk loading -->
                    <!-- begin:: untuk form -->
                    <div id="form-show">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Anggota Pegawai&nbsp;*</label>
                            <div class="col-sm-9">
                                <select name="id_pegawai_anggota" id="id_pegawai_anggota">
                                    <option value=""></option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Gaji&nbsp;*</label>
                            <div class="col-sm-9">
                                <select name="id_jenis_gaji" id="id_jenis_gaji">
                                    <option value=""></option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tunjangan&nbsp;*</label>
                            <div class="col-sm-9">
                                <select name="id_tunjangan" id="id_tunjangan">
                                    <option value=""></option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Bulan - Tahun (Awal)&nbsp;*</label>
                            <div class="col-sm-9">
                                <input type="month" class="form-control" name="awal_bulan" id="awal_bulan" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Bulan - Tahun (Akhir)&nbsp;*</label>
                            <div class="col-sm-9">
                                <input type="month" class="form-control" name="akhir_bulan" id="akhir_bulan" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nilai&nbsp;*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nilai" id="nilai" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan nilai" />
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
    var table;

    let untukTabel = function() {
        table = $('#tabel-pengembalian-dt').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: "{{ route('admin.pengembalian.get_data_dt', my_encrypt($ampra_gaji->id_ampra_gaji)) }}",
            columns: [{
                    title: 'No.',
                    data: 'DT_RowIndex',
                    class: 'text-center'
                },
                {
                    title: 'Nama Anggota Pegawai',
                    data: 'to_pegawai_anggota.nama',
                    class: 'text-center'
                },
                {
                    title: 'Jenis Gaji',
                    data: 'to_jenis_gaji.nama',
                    class: 'text-center'
                },
                {
                    title: 'Tunjangan',
                    data: 'to_tunjangan.nama',
                    class: 'text-center'
                },
                {
                    title: 'Bulan',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return getBulan(full.bulan);
                    },
                },
                {
                    title: 'Tahun',
                    data: 'tahun',
                    class: 'text-center'
                },
                {
                    title: 'Nilai',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return autoSeparator(full.nilai);
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

    let untukSimpanData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();

            $('#id_jenis_gaji').attr('required', 'required');
            $('#id_tunjangan').attr('required', 'required');
            $('#awal_bulan').attr('required', 'required');
            $('#akhir_bulan').attr('required', 'required');
            $('#nilai').attr('required', 'required');

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

    let untukSelectPegawaiAnggota = function() {
        $.get("{{ route('admin.pegawai.anggota.get_all') }}", {
            id_pegawai: '{{ $ampra_gaji->id_pegawai }}',
        }, function(response) {
            $("#id_pegawai_anggota").select2({
                placeholder: "Pilih Anggota Pegawai",
                dropdownParent: $('#modal-add-upd'),
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectJenisGaji = function() {
        $.get("{{ route('admin.jenis_gaji.get_all') }}", function(response) {
            $("#id_jenis_gaji").select2({
                placeholder: "Pilih Jenis Gaji",
                dropdownParent: $('#modal-add-upd'),
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectTunjangan = function() {
        $.get("{{ route('admin.tunjangan.get_all') }}", function(response) {
            $("#id_tunjangan").select2({
                placeholder: "Pilih tunjangan",
                dropdownParent: $('#modal-add-upd'),
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukTambahData = function() {
        $(document).on('click', '#add', function(e) {
            e.preventDefault();
            $('#judul-add-upd').text('Tambah');
            $('#id_pegawai_anggota').val('').trigger('change');
            $('#id_jenis_gaji').val('').trigger('change');
            $('#id_tunjangan').val('').trigger('change');

            $('#form-add-upd').parsley().reset();
            $('#form-add-upd')[0].reset();
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
                        url: "{{ route('admin.pengembalian.del') }}",
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