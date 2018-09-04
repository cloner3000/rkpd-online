{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('kegiatan') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Kegiatan</label>
        <select class="form-control m-select2" id="kegiatan" name="kegiatan">
            <option value="">-- Pilih Kegiatan --</option>
            @foreach($kegiatan as $key => $value)
                <option value="{{ $key }}"
                        {{ old('kegiatan') == $key || !empty($item) && $item->kegiatan_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('kegiatan'))
            <div class="form-control-feedback">
                {{ $errors->first('kegiatan') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('village') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Village</label>
        <select class="form-control m-select2" id="village" name="village">
            <option value="">-- Pilih Village --</option>
            @foreach($village as $key => $value)
                <option value="{{ $key }}"
                        {{ old('village') == $key || !empty($item) && $item->village_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('village'))
            <div class="form-control-feedback">
                {{ $errors->first('village') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('district') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">district</label>
        <select class="form-control m-select2" id="district" name="district">
            <option value="">-- Pilih district --</option>
            @foreach($district as $key => $value)
                <option value="{{ $key }}"
                        {{ old('district') == $key || !empty($item) && $item->district_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('district'))
            <div class="form-control-feedback">
                {{ $errors->first('district') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Lokasi Kegiatan</label>
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
        <a href="{{ route('lokasi-kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#village').select2({
            placeholder: "Pilih Village"
        });
        $('#district').select2({
            placeholder: "Pilih District"
        });
        $('#kegiatan').select2({
            placeholder: "Pilih Kegiatan"
        });
    </script>
@endpush