{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('visi') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Visi</label>
        <select class="form-control m-select2" id="visi" name="visi">
            <option value="">-- Pilih Visi --</option>
            @foreach($visi as $key => $value)
                <option value="{{ $key }}"
                        {{ old('visi') == $key || !empty($item) && $item->visi_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('visi'))
            <div class="form-control-feedback">
                {{ $errors->first('visi') }}
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
        <label class="form-control-label" for="inputDanger1">Urusan</label>
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
        <a href="{{ route('urusan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#visi').select2({
            placeholder: "Pilih Visi"
        });
    </script>
@endpush