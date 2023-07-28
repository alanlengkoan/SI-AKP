<form id="form-potongan" action="{{ route('admin.kartu_gaji.save') }}" method="POST">
    <!-- begin:: id -->
    <input type="hidden" name="tahap" id="tahap" value="potongan" />
    <input type="hidden" name="id_ampra_gaji" id="id_ampra_gaji" value="{{ $id_ampra_gaji }}" />
    <!-- end:: id -->

    <div class="modal-body">
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
        @foreach ($potongan as $row)
        @php
        $hitung = ($row->total * $row->persen);
        $total = ($row->persen == 0 ? $row->total : round($hitung));
        @endphp
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">{{ $row->nama }}</label>
            <div class="col-sm-9">
                <input type="hidden" name="id_potongan[]" value="{{ $row->id_potongan }}" />
                <input type="text" class="form-control" name="nilai[]" id="nilai" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan {{ $row->nama }}" value="{{ create_separator($total) }}" />
                <span class="errorInput"></span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <button type="button" id="cancel" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Batal</button>
        <button type="submit" id="save" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
    </div>
</form>

<script>
    var untukSelectJenisGaji = function() {
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
</script>