{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="col-md-12">
        <div class="form-group m-form__group {{ $errors->has('kegiatan') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="inputDanger1">Kegiatan</label>
            <select class="form-control m-select2" id="kegiatan" name="kegiatan">
                <option value="">-- Pilih Kegiatan --</option>
                @foreach($kegiatans as $key => $value)
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
    </div>
</div>

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('opd.opd-kegiatan.index', $id) }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#kegiatan').select2({
            placeholder: "Pilih Kegiatan"
        });
    </script>
@endpush