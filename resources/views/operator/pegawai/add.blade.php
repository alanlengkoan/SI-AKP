<!-- begin:: base -->
@extends('operator/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" href="{{ asset_admin('css/plugins/select2.min.css') }}" />
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
                        {{ Breadcrumbs::render('operator.pegawai.add') }}
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
                        <form id="form-add-upd" action="{{ route('operator.pegawai.save') }}" method="POST">
                            <!-- begin:: id -->
                            <input type="hidden" name="id_pegawai" id="id_pegawai" />
                            <!-- end:: id -->

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NIP&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control inputNumber" pattern="\d*" maxlength="18" minlength="18" name="nip" id="nip" placeholder="Masukkan nip" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kelamin" id="kelamin">
                                        <option value="" selected>- Pilih -</option>
                                        <option value="l">Laki - laki</option>
                                        <option value="p">Perempuan</option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis SKPP&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_jenis_skpp" id="id_jenis_skpp">
                                        <option value=""></option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <!-- begin:: mutasi pindah -->
                            <div class="mutasi-pindah"></div>
                            <!-- end:: mutasi pindah -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pangkat&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_pangkat" id="id_pangkat">
                                        <option value=""></option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jabatan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_jabatan" id="id_jabatan">
                                        <option value=""></option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Asal Surat Keputusan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_asal_surat_keputusan" id="id_asal_surat_keputusan">
                                        <option value=""></option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Surat Keputusan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_asal_surat_keputusan" id="no_asal_surat_keputusan" placeholder="Masukkan no. surat keputusan" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tgl. Surat Keputusan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgl_asal_surat_keputusan" id="tgl_asal_surat_keputusan" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. SP2D&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_sp2d" id="no_sp2d" placeholder="Masukkan no. sp2d" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tgl. SP2D&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgl_sp2d" id="tgl_sp2d" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tempat Tugas&nbsp;*</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="tmp_tugas" id="tmp_tugas" placeholder="Masukkan tempat tugas"></textarea>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <!-- begin:: mutasi gaji -->
                            <div class="mutasi-gaji"></div>
                            <!-- end:: mutasi gaji -->
                            <!-- begin:: mutasi pensiun -->
                            <div class="mutasi-pensiun"></div>
                            <!-- end:: mutasi pensiun -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gaji Terakhir di Bayarkan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="month" class="form-control" name="tgl_pelapor" id="tgl_pelapor" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Menikah&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_menikah" id="status_menikah">
                                        <option value="" selected>- Pilih -</option>
                                        <option value="y">Ya</option>
                                        <option value="n">Tidak</option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Meninggal&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_meninggal" id="status_meninggal">
                                        <option value="" selected>- Pilih -</option>
                                        <option value="y">Ya</option>
                                        <option value="n">Tidak</option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pas Foto 4X6&nbsp;*</label>
                                <div class="col-sm-9">
                                    <div id="lihat_gambar"></div>
                                    <input type="file" name="foto" id="foto" />
                                    <div id="centang_gambar"></div>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" id="save-akun" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                </div>
                            </div>
                        </form>
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
<script type="text/javascript" src="{{ asset_admin('my_assets/parsley/2.9.2/parsley.js') }}"></script>
<script type="text/javascript" src="{{ asset_admin('js/plugins/select2.full.min.js') }}"></script>

<script>
    let untukSimpanData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();
            var id_jenis_skpp = $('#id_jenis_skpp');

            $('#nip').attr('required', 'required');
            $('#nama').attr('required', 'required');
            $('#kelamin').attr('required', 'required');
            id_jenis_skpp.attr('required', 'required');
            $('#id_pangkat').attr('required', 'required');
            $('#id_jabatan').attr('required', 'required');
            $('#id_asal_surat_keputusan').attr('required', 'required');
            $('#no_asal_surat_keputusan').attr('required', 'required');
            $('#tgl_asal_surat_keputusan').attr('required', 'required');
            $('#no_sp2d').attr('required', 'required');
            $('#tgl_sp2d').attr('required', 'required');
            $('#tmp_tugas').attr('required', 'required');
            $('#gaji').attr('required', 'required');
            $('#tgl_pensiun').attr('required', 'required');
            $('#tgl_pelapor').attr('required', 'required');
            $('#status_menikah').attr('required', 'required');
            $('#status_meninggal').attr('required', 'required');
            $('#foto').attr('required', 'required');

            if (id_jenis_skpp.select2('data')[0].kode == 'spp') {
                $('#mutasi').attr('required', 'required');
            }

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
                            if (response.status === true) {
                                location.href = response.redirect;
                            } else {
                                location.reload();
                            }
                        });

                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            }
        });
    }();

    let untukJenisSkpp = function() {
        $("#id_jenis_skpp").on('change', function(e) {
            e.preventDefault();
            var ini = $(this).select2('data')[0];
            if (ini.kode === 'spp') {
                $('.mutasi-pindah').html(`
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Lokasi Mutasi&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="mutasi" id="mutasi" placeholder="Masukkan lokasi mutasi" />
                            <span class="errorInput"></span>
                        </div>
                    </div>
                `);
                $('.mutasi-gaji').empty();
                $('.mutasi-pensiun').html(`
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">TMT Pindah&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tgl_pensiun" id="tgl_pensiun" />
                            <span class="errorInput"></span>
                        </div>
                    </div>
                `);
            } else {
                $('.mutasi-pindah').empty();
                $('.mutasi-gaji').html(`
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gaji Pensiun Pokok&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="gaji" id="gaji" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan jumlah gaji" />
                            <span class="errorInput"></span>
                        </div>
                    </div>
                `);
                $('.mutasi-pensiun').html(`
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">TMT Pensiun&nbsp;*</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tgl_pensiun" id="tgl_pensiun" />
                            <span class="errorInput"></span>
                        </div>
                    </div>
                `);
            }
        });
    }();

    let untukSelectJenisSkpp = function() {
        $.get("{{ route('operator.jenis_skpp.get_all') }}", function(response) {
            $("#id_jenis_skpp").select2({
                placeholder: "Pilih jenis skpp",
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectPangkat = function() {
        $.get("{{ route('operator.pangkat.get_all') }}", function(response) {
            $("#id_pangkat").select2({
                placeholder: "Pilih pangkat",
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectJabatan = function() {
        $.get("{{ route('operator.jabatan.get_all') }}", function(response) {
            $("#id_jabatan").select2({
                placeholder: "Pilih Jabatan",
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectAsalSuratKeputusan = function() {
        $.get("{{ route('operator.asal_surat_keputusan.get_all') }}", function(response) {
            $("#id_asal_surat_keputusan").select2({
                placeholder: "Pilih Asal Surat Keputusan",
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();
</script>
@endsection
<!-- end:: js local -->