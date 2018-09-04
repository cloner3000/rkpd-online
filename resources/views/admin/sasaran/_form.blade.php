{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('tujuan_id') ? ' has-danger' : '' }}">
        <label class="form-control-label">Tujuan</label>
        <select class="form-control m-input" id="tujuan_id" name="tujuan_id">
            <option value="">-- Pilih Misi --</option>
            @foreach($tujuan as $key => $val)
                <option value="{{ $key }}" {{ $key == ($item->tujuan->id ?? false) ? 'selected' : '' }}>{{ $val }}</option>
            @endforeach
        </select>
        @if ($errors->has('tujuan_id'))
            <div class="form-control-feedback">
                {{ $errors->first('tujuan_id') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Sasaran</label>
        <input class="form-control m-input" id="nama" name="nama" placeholder="Masukan Sasaran"
               value="{{ old('nama', $item->nama ?? '') }}">
        @if ($errors->has('nama'))
        <div class="form-control-feedback">
            {{ $errors->first('nama') }}
        </div>
        @endif
    </div>

</div>
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>