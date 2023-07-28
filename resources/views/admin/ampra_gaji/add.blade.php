<!-- begin:: base -->
@extends('admin/base')
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
                        {{ Breadcrumbs::render('admin.ampra_gaji.add') }}
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
                        <form id="form-add-upd" action="{{ route('admin.ampra_gaji.save') }}" method="POST">
                            <!-- begin:: id -->
                            <input type="hidden" name="id_ampra_gaji" id="id_ampra_gaji" />
                            <!-- end:: id -->

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Surat&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Nomor Surat" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Tanggal Surat&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgl_surat" id="tgl_surat" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">NIP&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_pegawai" id="id_pegawai">
                                        <option value=""></option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bolder">Bertanda Tangan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_ttd" id="id_ttd">
                                        <option value=""></option>
                                    </select>
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
    let untukSelectPegawai = function() {
        $.get("{{ route('admin.pegawai.get_all') }}", function(response) {
            $("#id_pegawai").select2({
                placeholder: "Pilih Pegawai",
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSelectTtd = function() {
        $.get("{{ route('admin.ttd.get_all') }}", function(response) {
            $("#id_ttd").select2({
                placeholder: "Pilih Tanda Tangan",
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukSimpanData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();

            $('#no_surat').attr('required', 'required');
            $('#tgl_surat').attr('required', 'required');
            $('#id_pegawai').attr('required', 'required');
            $('#id_ttd').attr('required', 'required');

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
                            location.href = response.redirect;
                        });

                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            }
        });
    }();
</script>
@endsection
<!-- end:: js local -->