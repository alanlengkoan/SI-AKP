<!-- begin:: base -->
@extends('admin/base')
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
                        {{ Breadcrumbs::render('admin.ampra_gaji.tunjangan', $ampra_gaji) }}
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
                            <input type="hidden" name="id_ampra_gaji" id="id_ampra_gaji" value="{{ $ampra_gaji->id_ampra_gaji }}" />
                            <input type="hidden" name="tahap" id="tahap" value="tunjangan" />
                            <!-- end:: id -->

                            <h4>Pegawai</h4>
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
                            <hr>
                            <h4>Tunjangan</h4>
                            @foreach ($tunjangan as $row)
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label font-weight-bolder">{{ $row->nama }}</label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="id_tunjangan[]" value="{{ $row->id_tunjangan }}" />
                                    <input type="text" class="form-control" name="nilai[]" id="nilai" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" @if($row->nilai !== null) value="{{ create_separator($row->nilai) }}" @else '' @endif placeholder="Masukkan {{ $row->nama }}" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            @endforeach
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" id="save" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Proses</button>
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

<script>
    let untukSimpanData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();

            var nilai = $('[id="nilai"]');
            for (let i = 0; i < nilai.length; i++) {
                $(nilai[i]).attr('required', 'required');
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