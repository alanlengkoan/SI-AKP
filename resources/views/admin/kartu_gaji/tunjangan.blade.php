<form id="form-tunjangan" action="{{ route('admin.kartu_gaji.save') }}" method="POST">
    <!-- begin:: id -->
    <input type="hidden" name="tahap" id="tahap" value="tunjangan" />
    <!-- end:: id -->

    <div class="modal-body">
        @foreach ($tunjangan as $row)
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">{{ $row->nama }}</label>
            <div class="col-sm-9">
                <input type="hidden" name="id_tunjangan[]" value="{{ $row->id_tunjangan }}" />
                <input type="text" class="form-control" name="nilai[]" id="nilai" onkeydown="return justAngka(event)" onkeyup="javascript:this.value=autoSeparator(this.value);" placeholder="Masukkan {{ $row->nama }}" />
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