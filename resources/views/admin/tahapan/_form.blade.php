{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Tahapan</label>
        <input type="text" class="form-control form-control-danger m-input" id="nama" placeholder="Masukan Nama"
               name="nama" value="{{ old('nama', isset($item) ? $item->nama ?? '' : '') }}">
        @if ($errors->has('nama'))
        <div class="form-control-feedback">
            {{ $errors->first('nama') }}
        </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('mulai') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Mulai</label>
        <input type="text" class="form-control form-control-danger m-input" id="mulai" placeholder="Select date"
               name="mulai" value="{{ old('mulai', isset($item) ? $item->mulai->format('d-m-Y h:i') ?? '' : '') }}" readonly >
        @if ($errors->has('mulai'))
            <div class="form-control-feedback">
                {{ $errors->first('mulai') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('selesai') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Selesai</label>
        <input type="text" class="form-control form-control-danger m-input" id="selesai" placeholder="Select date"
               name="selesai" value="{{ old('selesai', isset($item) ? $item->selesai->format('d-m-Y h:i') ?? '' : '') }}" readonly >
        @if ($errors->has('selesai'))
            <div class="form-control-feedback">
                {{ $errors->first('selesai') }}
            </div>
        @endif
    </div>

</div>

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tahapan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>

        $('#mulai, #selesai').datetimepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'dd-mm-yyyy hh:ii'
        });
    </script>
@endpush