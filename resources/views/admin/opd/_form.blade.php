{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('jenis_opd') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Jenis OPD</label>
        <select class="form-control m-select2" id="jenis_opd" name="jenis_opd">
            <option value="">-- Pilih OPD --</option>
            @foreach($jenis_opd as $key => $value)
                <option value="{{ $key }}"
                        {{ old('jenis_opd') == $key || !empty($item) && $item->jenis_opd_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('jenis_opd'))
            <div class="form-control-feedback">
                {{ $errors->first('jenis_opd') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('kode') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Kode</label>
        <input type="number" class="form-control form-control-danger m-input" id="name" placeholder="Masukan Kode"
               name="kode" value="{{ old('kode', $item->kode ?? '') }}" min="0">
        @if ($errors->has('kode'))
            <div class="form-control-feedback">
                {{ $errors->first('kode') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">OPD</label>
        <input type="text" class="form-control form-control-danger m-input" id="nama" placeholder="Masukan Nama"
               name="nama" value="{{ old('nama', $item->nama ?? '') }}">
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
        <a href="{{ route('opd.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#jenis_opd').select2({
            placeholder: "Pilih Jenis OPD"
        });
    </script>
@endpush