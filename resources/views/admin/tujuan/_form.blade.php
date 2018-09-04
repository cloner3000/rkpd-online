{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('misi_id') ? ' has-danger' : '' }}">
        <label class="form-control-label">Misi</label>
        <select class="form-control m-input" id="misi_id" name="misi_id">
            <option value="">-- Pilih Misi --</option>
            @foreach($misi as $key => $val)
                <option value="{{ $key }}" {{ $key == ($item->misi->id ?? false) ? 'selected' : '' }}>{{ $val }}</option>
            @endforeach
        </select>
        @if ($errors->has('misi_id'))
            <div class="form-control-feedback">
                {{ $errors->first('misi_id') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Tujuan</label>
        <input class="form-control m-input" id="nama" name="nama" placeholder="Masukan Tujuan"
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