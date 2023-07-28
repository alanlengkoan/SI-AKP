<!-- begin:: base -->
@extends('operator/base')
<!-- end:: base -->

<!-- begin:: css local -->
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables/1.11.3/css/dataTables.bootstrap4.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset_admin('my_assets/datatables-responsive/2.2.9/css/responsive.dataTables.min.css') }}" />
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
                        {{ Breadcrumbs::render('operator.pegawai.upd', $pegawai) }}
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
                            <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{ $pegawai->id_pegawai }}" />
                            <!-- end:: id -->

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">NIP&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nip" id="nip" value="{{ $pegawai->nip }}" placeholder="Masukkan nip" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $pegawai->nama }}" placeholder="Masukkan nama" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kelamin" id="kelamin">
                                        <option value="" selected>- Pilih -</option>
                                        <option value="l" {{ ($pegawai->kelamin === 'l' ? 'selected' : '') }}>Laki - laki</option>
                                        <option value="p" {{ ($pegawai->kelamin === 'p' ? 'selected' : '') }}>Perempuan</option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis SKPP&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_jenis_skpp" id="id_jenis_skpp">
                                        <option value=""></option>
                                        @foreach($jenis_skpp as $row)
                                        <option value="{{ $row->id_jenis_skpp }}" data-kode="{{ $row->kode }}" {{ ($pegawai->id_jenis_skpp == $row->id_jenis_skpp ? 'selected' : '') }}>{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <!-- begin:: mutasi pindah -->
                            <div class="mutasi-pindah">
                                @if($pegawai->toJenisSkpp->kode === 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Lokasi Mutasi&nbsp;*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="mutasi" id="mutasi" value="{{ $pegawai->mutasi }}" placeholder="Masukkan lokasi mutasi" />
                                        <span class="errorInput"></span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!-- end:: mutasi pindah -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pangkat&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_pangkat" id="id_pangkat">
                                        <option value=""></option>
                                        @foreach($pangkat as $row)
                                        <option value="{{ $row->id_pangkat }}" {{ ($pegawai->id_pangkat == $row->id_pangkat  ? 'selected' : '') }}>{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jabatan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_jabatan" id="id_jabatan">
                                        <option value=""></option>
                                        @foreach($jabatan as $row)
                                        <option value="{{ $row->id_jabatan }}" {{ ($pegawai->id_jabatan == $row->id_jabatan  ? 'selected' : '') }}>{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Asal Surat Keputusan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select name="id_asal_surat_keputusan" id="id_asal_surat_keputusan">
                                        <option value=""></option>
                                        @foreach($asal_surat_keputusan as $row)
                                        <option value="{{ $row->id_asal_surat_keputusan }}" {{ ($pegawai->id_asal_surat_keputusan == $row->id_asal_surat_keputusan ? 'selected' : '') }}>{{ $row->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. Surat Keputusan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_asal_surat_keputusan" id="no_asal_surat_keputusan" value="{{ $pegawai->no_asal_surat_keputusan }}" placeholder="Masukkan no. surat keputusan" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tgl. Surat Keputusan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgl_asal_surat_keputusan" id="tgl_asal_surat_keputusan" value="{{ $pegawai->tgl_asal_surat_keputusan }}" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">No. SP2D&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_sp2d" id="no_sp2d" value="{{ $pegawai->no_sp2d }}" placeholder="Masukkan no. sp2d" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tgl. SP2D&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgl_sp2d" id="tgl_sp2d" value="{{ $pegawai->tgl_sp2d }}" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tempat Tugas&nbsp;*</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="tmp_tugas" id="tmp_tugas" placeholder="Masukkan tempat tugas">{{ $pegawai->tmp_tugas }}</textarea>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <!-- begin:: mutasi gaji -->
                            <div class="mutasi-gaji">
                                @if($pegawai->toJenisSkpp->kode !== 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Gaji Pensiun Pokok&nbsp;*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="gaji" id="gaji" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" value="{{ create_separator($pegawai->gaji) }}" placeholder="Masukkan jumlah gaji" />
                                        <span class="errorInput"></span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!-- end:: mutasi gaji -->
                            <!-- begin:: mutasi pensiun -->
                            <div class="mutasi-pensiun">
                                @if($pegawai->toJenisSkpp->kode === 'spp')
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">TMT Pindah&nbsp;*</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tgl_pensiun" id="tgl_pensiun" value="{{ $pegawai->tgl_pensiun }}" />
                                        <span class="errorInput"></span>
                                    </div>
                                </div>
                                @else
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">TMT Pensiun&nbsp;*</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tgl_pensiun" id="tgl_pensiun" value="{{ $pegawai->tgl_pensiun }}" />
                                        <span class="errorInput"></span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!-- end:: mutasi pensiun -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gaji Terakhir di Bayarkan&nbsp;*</label>
                                <div class="col-sm-9">
                                    <input type="month" class="form-control" name="tgl_pelapor" id="tgl_pelapor" value="{{ date('Y-m', strtotime($pegawai->tgl_pelapor)) }}" />
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Menikah&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_menikah" id="status_menikah">
                                        <option value="" selected>- Pilih -</option>
                                        <option value="y" {{ ($pegawai->status_menikah === 'y' ? 'selected' : '') }}>Ya</option>
                                        <option value="n" {{ ($pegawai->status_menikah === 'n' ? 'selected' : '') }}>Tidak</option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status Meninggal&nbsp;*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_meninggal" id="status_meninggal">
                                        <option value="" selected>- Pilih -</option>
                                        <option value="y" {{ ($pegawai->status_meninggal === 'y' ? 'selected' : '') }}>Ya</option>
                                        <option value="n" {{ ($pegawai->status_meninggal === 'n' ? 'selected' : '') }}>Tidak</option>
                                    </select>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pas Foto 4X6&nbsp;*</label>
                                <div class="col-sm-9">
                                    <img style="padding-bottom: 10px" src="{{ ($pegawai->foto === null ? '//placehold.co/150' : asset_upload('picture/'.$pegawai->foto)) }}" width="100" heigth="100" />
                                    <br>
                                    <input type="file" name="foto" disabled="disabled" />
                                    <br>
                                    <label style="padding-top: 10px"><input type="checkbox" name="change_picture" id="change_picture" />&nbsp;Ubah Foto!</label>
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

                @if($pegawai->status_menikah === 'y')
                <div class="card">
                    <div class="card-header">
                        <h5>Anggota Keluarga Pegawai</h5>
                        <div class="card-header-right">
                            <button type="button" id="add-pegawai-anggota" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add-upd-pegawai-anggota" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="tabel-pegawai-anggota-dt" style="width: 100%;">
                        </table>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Berkas Pegawai</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($pegawai_berkas as $row)
                        <form class="form-add-upd-pegawai-berkas" id="form-add-upd-pegawai-berkas-{{ $loop->index }}" action="{{ route('operator.pegawai.berkas.save') }}" method="POST">
                            <!-- begin:: id -->
                            <input type="hidden" name="aksi" value="upd" />
                            <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{ $pegawai->id_pegawai }}" />
                            <!-- end:: id -->

                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label">{{ $row->berkas_skpp }}&nbsp;* | {{ $row->jumlah }} Lembar</label>
                                <div class="col-sm-6">
                                    @if (get_extension($row->file) == 'pdf')
                                    <embed style="height: 500px;" src="{{ asset_upload('doc/' . $row->file) }}" type="application/pdf" frameBorder="0" scrolling="auto" height="100%" width="100%"></embed>
                                    @else
                                    <img style="padding-bottom: 10px" src="{{ ($row->file === null ? '//placehold.co/150' : asset_upload('picture/'.$row->file)) }}" class="img-fluid" width="500" heigth="500" />
                                    @endif
                                    <br>
                                    <input type="hidden" name="id_berkas_skpp" value="{{ $row->id_berkas_skpp }}" />
                                    <input type="file" name="file" id="file-{{ $loop->index }}" />
                                    <p>File dengan tipe (*.pdf,*.jpg) Max. 20MB</p>
                                    <span class="errorInput"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 col-form-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" id="save-akun" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: body -->
    </div>
</div>

<!-- begin:: modal tambah & ubah -->
<div id="modal-add-upd-pegawai-anggota" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="judul-add-upd-pegawai-anggota"></span> Anggota Keluarga Pegawai</h4>
            </div>
            <form id="form-add-upd-pegawai-anggota" action="{{ route('operator.pegawai.anggota.save') }}" method="POST">
                <!-- begin:: id -->
                <input type="hidden" name="id_pegawai_anggota" id="id_pegawai_anggota" />
                <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{ $pegawai->id_pegawai }}" />
                <!-- end:: id -->

                <div class="modal-body">
                    <!-- begin:: untuk loading -->
                    <div id="form-loading"></div>
                    <!-- end:: untuk loading -->
                    <!-- begin:: untuk form -->
                    <div id="form-show">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama&nbsp;*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_pegawai_anggota" id="nama_pegawai_anggota" placeholder="Masukkan nama anggota keluarga" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin&nbsp;*</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="kelamin_pegawai_anggota" id="kelamin_pegawai_anggota">
                                    <option value="" selected>- Pilih -</option>
                                    <option value="l">Laki - laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Lahir&nbsp;*</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tgl_lahir_pegawai_anggota" id="tgl_lahir_pegawai_anggota" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat Lahir&nbsp;*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tmp_lahir_pegawai_anggota" id="tmp_lahir_pegawai_anggota" placeholder="Masukkan tempat lahir" />
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Anggota Keluarga&nbsp;*</label>
                            <div class="col-sm-9">
                                <select name="id_jenis_anggota_pegawai_anggota" id="id_jenis_anggota_pegawai_anggota">
                                    <option value=""></option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggungan&nbsp;*</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status_tanggungan_pegawai_anggota" id="status_tanggungan_pegawai_anggota">
                                    <option value="" selected>- Pilih -</option>
                                    <option value="y">Ya</option>
                                    <option value="n">Tidak</option>
                                </select>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Catatan&nbsp;*</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="keterangan_pegawai_anggota" id="keterangan_pegawai_anggota" placeholder="Masukkan catatan"></textarea>
                                <span class="errorInput"></span>
                            </div>
                        </div>
                    </div>
                    <!-- end:: untuk form -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancel-pegawai-anggota" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Batal</button>
                    <button type="submit" id="save-pegawai-anggota" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
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
    var tablePegawaiAnggota;

    let untukTabelAnggotaPegawai = function() {
        tablePegawaiAnggota = $('#tabel-pegawai-anggota-dt').DataTable({
            responsive: true,
            processing: true,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                processing: "Data sedang diproses...",
            },
            ajax: {
                url: "{{ route('operator.pegawai.anggota.get_data_dt') }}",
                type: 'GET',
                data: {
                    id_pegawai: '{{ $pegawai->id_pegawai }}'
                }
            },
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
                    title: 'Jenis Anggota Keluarga',
                    data: 'to_jenis_anggota.nama',
                    class: 'text-center'
                },
                {
                    title: 'Jenis Kelamin',
                    data: null,
                    class: 'text-center',
                    render: function(data, type, full, meta) {
                        return (full.kelamin === 'l' ? 'Laki - laki' : 'Perempuan');
                    },
                },
                {
                    title: 'Tanggal Lahir',
                    data: null,
                    class: 'text-center',
                    render: function(data, type, full, meta) {
                        return tglIndo(full.tgl_lahir);
                    },
                },
                {
                    title: 'Tempat Lahir',
                    data: 'tmp_lahir',
                    class: 'text-center'
                },
                {
                    title: 'Status Tanggungan',
                    data: null,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return (full.status_tanggungan === 'y' ? '<span class="badge badge-success">Ya</span>' : '<span class="badge badge-danger">Tidak</span>');
                    },
                },
                {
                    title: 'Catatan',
                    data: 'keterangan',
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
                            <button type="button" id="upd-pegawai-anggota" data-id="` + full.id_pegawai_anggota + `" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-upd-pegawai-anggota" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i>&nbsp;Ubah</button>&nbsp;
                            <button type="button" id="del-pegawai-anggota" data-id="` + full.id_pegawai_anggota + `" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        `;
                    },
                },
            ],
        });
    }();

    let untukSimpanDataBerkasPegawai = function() {
        var form = $('[class="form-add-upd-pegawai-berkas"]');
        for (let i = 0; i < form.length; i++) {
            $(document).on('submit', '#form-add-upd-pegawai-berkas-' + i, function(e) {
                e.preventDefault();

                var ini = $(this);

                $('#file-' + i).attr('required', 'required');

                var parsleyConfig = {
                    errorsContainer: function(parsleyField) {
                        var $err = parsleyField.$element.siblings('.errorInput');
                        return $err;
                    }
                };

                $('#form-add-upd-pegawai-berkas-' + i).parsley(parsleyConfig);

                if ($('#form-add-upd-pegawai-berkas-' + i).parsley().isValid() == true) {
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
                                location.reload();
                            });

                            $('#save').removeAttr('disabled');
                            $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                        }
                    });
                }
            });
        }
    }();

    let untukSimpanDataAnggotaPegawai = function() {
        $(document).on('submit', '#form-add-upd-pegawai-anggota', function(e) {
            e.preventDefault();

            $('#id_jenis_anggota_pegawai_anggota').attr('required', 'required');
            $('#nama_pegawai_anggota').attr('required', 'required');
            $('#kelamin_pegawai_anggota').attr('required', 'required');
            $('#tgl_lahir_pegawai_anggota').attr('required', 'required');
            $('#tmp_lahir_pegawai_anggota').attr('required', 'required');
            $('#keterangan_pegawai_anggota').attr('required', 'required');
            $('#status_tanggungan_pegawai_anggota').attr('required', 'required');

            var parsleyConfig = {
                errorsContainer: function(parsleyField) {
                    var $err = parsleyField.$element.siblings('.errorInput');
                    return $err;
                }
            };

            $("#form-add-upd-pegawai-anggota").parsley(parsleyConfig);

            if ($('#form-add-upd-pegawai-anggota').parsley().isValid() == true) {
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
                            $('#modal-add-upd-pegawai-anggota').modal('hide');
                            tablePegawaiAnggota.ajax.reload();
                        });

                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            }
        });
    }();

    let untukSelectJenisAnggota = function() {
        $.get("{{ route('operator.jenis_anggota.get_all') }}", function(response) {
            $("#id_jenis_anggota_pegawai_anggota").select2({
                placeholder: "Pilih jenis anggota",
                dropdownParent: $('#modal-add-upd-pegawai-anggota'),
                width: '100%',
                allowClear: true,
                data: response,
            });
        }, 'json');
    }();

    let untukTambahDataPegawaiAnggota = function() {
        $(document).on('click', '#add-pegawai-anggota', function(e) {
            e.preventDefault();
            $('#judul-add-upd-pegawai-anggota').text('Tambah');

            $('#id_pegawai_anggota').removeAttr('value');
            $('#id_jenis_anggota_pegawai_anggota').val('').trigger('change');

            $('#form-add-upd-pegawai-anggota').parsley().reset();
            $('#form-add-upd-pegawai-anggota')[0].reset();
        });
    }();

    let untukUbahDataPegawaiAnggota = function() {
        $(document).on('click', '#upd-pegawai-anggota', function(e) {
            var ini = $(this);
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "{{ route('operator.pegawai.anggota.get') }}",
                data: {
                    id: ini.data('id')
                },
                beforeSend: function() {
                    $('#judul-add-upd-pegawai-anggota').html('Ubah');
                    $('#form-loading').html(`<div class="center"><div class="loader"></div></div>`);
                    $('#form-show').attr('style', 'display: none');

                    ini.attr('disabled', 'disabled');
                    ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                },
                success: function(response) {
                    $('#form-loading').empty();
                    $('#form-show').removeAttr('style');

                    $('#id_pegawai_anggota').val(response.id_pegawai_anggota);
                    $('#id_jenis_anggota_pegawai_anggota').val(response.id_jenis_anggota).trigger('change');
                    $('#nama_pegawai_anggota').val(response.nama);
                    $('#kelamin_pegawai_anggota').val(response.kelamin);
                    $('#tgl_lahir_pegawai_anggota').val(response.tgl_lahir);
                    $('#tmp_lahir_pegawai_anggota').val(response.tmp_lahir);
                    $('#keterangan_pegawai_anggota').val(response.keterangan);
                    $('#status_tanggungan_pegawai_anggota').val(response.status_tanggungan).trigger('change');

                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-edit"></i>&nbsp;Ubah');
                }
            });
        });
    }();

    let untukHapusDataPegawaiAnggota = function() {
        $(document).on('click', '#del-pegawai-anggota', function() {
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
                        url: "{{ route('operator.pegawai.anggota.del') }}",
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
                                tablePegawaiAnggota.ajax.reload();
                            });
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    }();

    let untukSimpanData = function() {
        $(document).on('submit', '#form-add-upd', function(e) {
            e.preventDefault();

            $('#nip').attr('required', 'required');
            $('#nama').attr('required', 'required');
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
                            location.reload();
                        });

                        $('#save').removeAttr('disabled');
                        $('#save').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            }
        });
    }();

    let untukUbahFoto = function() {
        $(document).on('click', '#change_picture', function() {
            var ini = $(this);
            if (ini.is(':checked')) {
                $("input[name*='foto']").removeAttr('disabled');
                $("input[name*='foto']").attr('id', 'foto');
            } else {
                $("input[name*='foto']").attr('disabled', 'disabled');
                $("input[name*='foto']").removeAttr('id');
                $("input[name*='foto']").removeAttr('required');
                ini.parent().parent().find('#error').empty();
            }
        });
    }();

    let untukJenisSkpp = function() {
        $("#id_jenis_skpp").on('change', function(e) {
            e.preventDefault();
            var ini = $(this);
            if (ini.find(":selected").data("kode") === 'spp') {
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
        $("#id_jenis_skpp").select2({
            placeholder: "Pilih jenis skpp",
            width: '100%',
            allowClear: true,
        });
    }();

    let untukSelectPangkat = function() {
        $("#id_pangkat").select2({
            placeholder: "Pilih pangkat",
            width: '100%',
            allowClear: true,
        });
    }();

    let untukSelectJabatan = function() {
        $("#id_jabatan").select2({
            placeholder: "Pilih Jabatan",
            width: '100%',
            allowClear: true,
        });
    }();

    let untukSelectAsalSuratKeputusan = function() {
        $("#id_asal_surat_keputusan").select2({
            placeholder: "Pilih Asal Surat Keputusan",
            width: '100%',
            allowClear: true,
        });
    }();
</script>
@endsection
<!-- end:: js local -->