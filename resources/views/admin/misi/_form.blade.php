{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('visi_id') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="visi_id">Visi</label>
        <select class="form-control m-input" id="visi_id" name="visi_id">
            <option value="">-- Pilih Visi --</option>
            @foreach($visi as $key => $val)
                <option value="{{ $key }}" {{ $key == (old('visi_id' ?? $item->visi->id) ?? false) ? 'selected' : '' }}>{{ $val }}</option>
            @endforeach
        </select>
        @if ($errors->has('visi_id'))
            <div class="form-control-feedback">
                {{ $errors->first('visi_id') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Misi</label>
        <input class="form-control m-input" id="nama" name="nama" placeholder="Masukan Misi"
               value="{{ old('urutan', $item->nama ?? '') }}">
        @if ($errors->has('nama'))
        <div class="form-control-feedback">
            {{ $errors->first('nama') }}
        </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('urutan') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Urutan</label>
        <input class="form-control form-control-danger m-input" type="number" id="urutan" name="urutan"
               value="{{ old('urutan', $item->urutan ?? 0) }}">
        @if ($errors->has('urutan'))
            <div class="form-control-feedback">
                {{ $errors->first('urutan') }}
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

@push('footer.javascript')
    <script>
        $("#mulai").change(function() {
            var val = parseInt($("#mulai option:selected").val());
            $('#selesai').val(val + 5).trigger('change');
            if (val > 2094) {
                $('#selesai').val(2099).trigger('change');
            }
        });
    </script>
@endpush