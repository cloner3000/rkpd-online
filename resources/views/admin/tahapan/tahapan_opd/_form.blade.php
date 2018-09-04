{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="col-md-12">
        <div class="form-group m-form__group {{ $errors->has('opd') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="inputDanger1">OPD</label>
            <select class="form-control m-select2" id="opd" name="opd">
                <option value="">-- Pilih OPD --</option>
                @foreach($opd as $key => $value)
                    <option value="{{ $key }}"
                            {{ old('opd') == $key || !empty($item) && $item->opd_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('opd'))
                <div class="form-control-feedback">
                    {{ $errors->first('opd') }}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tahapan.opd.index', $id) }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#opd').select2({
            placeholder: "-- Pilih OPD --"
        });
    </script>
@endpush