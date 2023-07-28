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
                        {{ Breadcrumbs::render('operator.pegawai.berkas.add', $pegawai) }}
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
                        @foreach ($jenis_berkas_skpp as $row)
                        <form class="form-add-upd" id="form-add-upd-{{ $loop->index }}" action="{{ route('operator.pegawai.berkas.save') }}" method="POST">
                            <!-- begin:: id -->
                            <input type="hidden" name="aksi" value="add" />
                            <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{ $pegawai->id_pegawai }}" />
                            <!-- end:: id -->

                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">{{ $row->berkas_skpp }}&nbsp;* | {{ $row->jumlah }} Lembar</label>
                                <div class="col-sm-6">
                                    @if ($row->file === null)
                                    <input type="hidden" name="id_berkas_skpp" value="{{ $row->id_berkas_skpp }}" />
                                    <input type="file" name="file" id="file-{{ $loop->index }}" />
                                    <p>File dengan tipe (*.pdf,*.jpg) Max. 20MB</p>
                                    <span class="errorInput"></span>
                                    @else
                                    @if (get_extension($row->file) == 'pdf')
                                    <a href="{{ asset_upload('doc/' . $row->file) }}" target="_blank">{{ $row->file }}</a>
                                    @else
                                    <a href="{{ asset_upload('picture/'.$row->file) }}" target="_blank">{{ $row->file }}</a>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </form>
                        @endforeach
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label"></label>
                            <div class="col-sm-6">
                                <button type="button" id="save" data-id_pegawai="{{ $pegawai->id_pegawai }}" data-id_jenis_skpp="{{ $pegawai->id_jenis_skpp }}" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                            </div>
                        </div>
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

<script>
    let untukSimpanData = function() {
        var form = $('[class="form-add-upd"]');

        for (let i = 0; i < form.length; i++) {
            $('#file-' + i).change(function() {
                $('#form-add-upd-' + i).submit();
            });

            $(document).on('submit', '#form-add-upd-' + i, function(e) {
                e.preventDefault();

                var ini = $(this);

                $('#file-' + i).attr('required', 'required');

                var parsleyConfig = {
                    errorsContainer: function(parsleyField) {
                        var $err = parsleyField.$element.siblings('.errorInput');
                        return $err;
                    }
                };

                $('#form-add-upd-' + i).parsley(parsleyConfig);

                if ($('#form-add-upd-' + i).parsley().isValid() == true) {
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
                        success: function(response) {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        }
    }();

    let untukValidasiData = function() {
        $(document).on('click', '#save', function(e) {
            e.preventDefault();

            $.ajax({
                method: 'POST',
                url: "{{ route('operator.pegawai.berkas.check') }}",
                data: {
                    id_pegawai: $(this).data('id_pegawai'),
                    id_jenis_skpp: $(this).data('id_jenis_skpp')
                },
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
                        }
                    });

                    $('#save').removeAttr('disabled');
                    $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                }
            });
        });
    }();
</script>
@endsection
<!-- end:: js local -->