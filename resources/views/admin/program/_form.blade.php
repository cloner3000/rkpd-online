{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('bidang_urusan') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Bidang Urusan</label>
        <select class="form-control m-select2" id="bidang_urusan" name="bidang_urusan">
            <option value="">-- Pilih Bidang Urusan --</option>
            @foreach($bidang_urusan as $key => $value)
                <option value="{{ $key }}"
                        {{ old('bidang_urusan') == $key || !empty($item) && $item->bidang_urusan_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('bidang_urusan'))
            <div class="form-control-feedback">
                {{ $errors->first('bidang_urusan') }}
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
        <label class="form-control-label" for="inputDanger1">Program</label>
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
        <a href="{{ route('program.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#bidang_urusan').select2({
            placeholder: "Pilih Bidang Urusan"
        });
    </script>
@endpush