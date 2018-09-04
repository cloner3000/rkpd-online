{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('sasaran_id') ? ' has-danger' : '' }}">
        <label class="form-control-label">Sasaran</label>
        <select class="form-control m-input" id="sasaran_id" name="sasaran_id">
            <option value="">-- Pilih Sasaran --</option>
            @foreach($sasaran as $key => $val)
                <option value="{{ $key }}" {{ $key == ($item->sasaran->id ?? false) ? 'selected' : '' }}>{{ $val }}</option>
            @endforeach
        </select>
        @if ($errors->has('sasaran_id'))
            <div class="form-control-feedback">
                {{ $errors->first('sasaran_id') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $item->nama ?? "") }}">
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

@push('footer.javascript')
    <script src="{{ asset('/metronic/assets/demo/default/custom/components/forms/widgets/input-mask.js') }}" type="text/javascript"></script>
@endpush