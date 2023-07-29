<!-- begin:: base -->
@extends('admin/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
@endsection
<!-- end:: css local -->

<!-- begin:: content -->
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills bg-white" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="foto-tab" data-toggle="tab" href="#foto" role="tab" aria-controls="foto" aria-selected="true">
                            Foto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="akun-tab" data-toggle="tab" href="#akun" role="tab" aria-controls="akun" aria-selected="true">
                            Akun
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="keamanan-tab" data-toggle="tab" href="#keamanan" role="tab" aria-controls="keamanan" aria-selected="true">
                            Keamanan
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <!-- begin:: foto -->
            <div class="tab-pane fade show active" id="foto" role="tabpanel" aria-labelledby="foto-tab">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Foto {{ $title }}</h5>
                            </div>
                            <div class="card-body">
                                <form id="form-foto" action="{{ route('admin.profil.save_picture') }}" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6 align-self-center">
                                            <input type="file" name="i_foto" id="i_foto" />
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="{{ ($user->foto === null) ? '//placehold.co/150' : asset_upload('picture/'.$user->foto) }}" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="Profil" width="200" />
                                            <br>
                                            <div class="text-center">
                                                <button type="submit" id="save-foto" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end:: foto -->
            <!-- begin:: akun -->
            <div class="tab-pane fade" id="akun" role="tabpanel" aria-labelledby="akun-tab">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Akun {{ $title }}</h5>
                                <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
                                    <i class="feather icon-edit"></i>
                                </button>
                            </div>
                            <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Nama</label>
                                    <div class="col-sm-9">
                                        {{ $user->nama }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">E-Mail</label>
                                    <div class="col-sm-9">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bolder">Username</label>
                                    <div class="col-sm-9">
                                        {{ $user->username }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top pro-det-edit collapse " id="pro-det-edit-2">
                                <form id="form-akun" action="{{ route('admin.profil.save_account') }}" method="POST">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Nama&nbsp;*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="i_nama" id="i_nama" value="{{ $user->nama }}" placeholder="Masukkan nama Anda" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">E-Mail&nbsp;*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="i_email" id="i_email" value="{{ $user->email }}" placeholder="Masukkan e-mail Anda" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Username&nbsp;*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="i_username" id="i_username" value="{{ $user->username }}" placeholder="Masukkan username Anda" />
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
            </div>
            <!-- end:: akun -->
            <!-- begin:: keamanan -->
            <div class="tab-pane fade" id="keamanan" role="tabpanel" aria-labelledby="keamanan-tab">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Keamanan {{ $title }}</h5>
                            </div>
                            <div class="card-body">
                                <form id="form-keamanan" action="{{ route('admin.profil.save_security') }}" method="POST">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password Lama&nbsp;*</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="i_pass_lama" id="i_pass_lama" placeholder="Masukkan password lama Anda" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Password Baru&nbsp;*</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="i_pass_baru" id="i_pass_baru" placeholder="Masukkan password baru Anda" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bolder">Ulangi Password Baru&nbsp;*</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="i_pass_baru_lagi" id="i_pass_baru_lagi" placeholder="Masukkan kembali password Anda" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" id="save-keamanan" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end:: keamanan -->
        </div>
    </div>
</div>
@endsection
<!-- end:: content -->

<!-- begin:: js local -->
@section('js')
<script type="text/javascript" src="{{ asset_admin('my_assets/parsley/2.9.2/parsley.js') }}"></script>

<script>
    let untukChangePicture = function() {
        $("#i_foto").change(function() {
            cekLokasiFoto(this);
        });
    }();

    let untukSimpanFoto = function() {
        $(document).on('submit', '#form-foto', function(e) {
            e.preventDefault();
            $('#i_foto').attr('required', 'required');

            if ($('#form-foto').parsley().isValid() == true) {
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
                        $('#save-foto').attr('disabled', 'disabled');
                        $('#save-foto').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
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
    }();

    let untukSimpanAkun = function() {
        $(document).on('submit', '#form-akun', function(e) {
            e.preventDefault();
            $('#i_nama').attr('required', 'required');
            $('#i_email').attr('required', 'required');
            $('#i_username').attr('required', 'required');

            if ($('#form-akun').parsley().isValid() == true) {
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
                        $('#save-akun').attr('disabled', 'disabled');
                        $('#save-akun').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
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
    }();

    let untukSimpanKeamanan = function() {
        $(document).on('submit', '#form-keamanan', function(e) {
            e.preventDefault();
            $('#i_pass_lama').attr('required', 'required');
            $('#i_pass_baru').attr('required', 'required');
            $('#i_pass_baru_lagi').attr('required', 'required');

            if ($('#form-keamanan').parsley().isValid() == true) {
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
                        $('#save-keamanan').attr('disabled', 'disabled');
                        $('#save-keamanan').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
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
    }();

    // untuk baca lokasi gambar
    function cekLokasiFoto(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function(e) {
                $('#lihat-gambar').attr('src', e.target.result);
            }
        }
    }
</script>
@endsection
<!-- end:: js local -->