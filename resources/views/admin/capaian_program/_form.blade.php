{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('program') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Program</label>
        <select class="form-control m-select2" id="program" name="program">
            <option value="">-- Pilih Program --</option>
            @foreach($program as $key => $value)
                <option value="{{ $key }}"
                        {{ old('program') == $key || !empty($item) && $item->program_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('program'))
            <div class="form-control-feedback">
                {{ $errors->first('program') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('satuan') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Satuan</label>
        <select class="form-control m-select2" id="satuan" name="satuan">
            <option value="">-- Pilih Satuan --</option>
            @foreach($satuan as $key => $value)
                <option value="{{ $key }}"
                        {{ old('satuan') == $key || !empty($item) && $item->satuan_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('satuan'))
            <div class="form-control-feedback">
                {{ $errors->first('satuan') }}
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

    <div class="form-group m-form__group {{ $errors->has('tolak_ukur') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Tolak Ukur</label>
        <input type="text" class="form-control form-control-danger m-input" id="tolak_ukur" placeholder="Masukan Tolak Ukur"
               name="tolak_ukur" value="{{ old('tolak_ukur', $item->tolak_ukur ?? '') }}">
        @if ($errors->has('tolak_ukur'))
        <div class="form-control-feedback">
            {{ $errors->first('tolak_ukur') }}
        </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('target') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Target</label>
        <input type="number" class="form-control form-control-danger m-input" id="name" placeholder="Masukan Target"
               name="target" value="{{ old('target', $item->target ?? '') }}" min="0">
        @if ($errors->has('target'))
            <div class="form-control-feedback">
                {{ $errors->first('target') }}
            </div>
        @endif
    </div>
</div>

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('capaian-program.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#program').select2({
            placeholder: "Pilih Program"
        });
        $('#satuan').select2({
            placeholder: "Pilih Satuan"
        });
    </script>
@endpush