{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Visi</label>
        <input class="form-control m-input" id="nama" name="nama" value="{!! old('nama', $item->nama ?? "")  !!}">
        @if ($errors->has('nama'))
            <div class="form-control-feedback">
                {{ $errors->first('nama') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('mulai') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Tahun Mulai</label>
        <select class="form-control m-input" id="mulai" name="mulai">
            @for($i=2016; $i<= 2099; $i++)
                <option value="{{ $i }}" {{ !empty($item) ? $i == $item->mulai ? 'selected' : '' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        @if ($errors->has('mulai'))
            <div class="form-control-feedback">
                {{ $errors->first('mulai') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('selesai') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Tahun Selesai</label>
        <select class="form-control m-input" id="selesai" disabled="disabled">
            @for($i = 2016; $i <= 2099; $i++)
                <option {{ !empty($item) ? $i == $item->selesai  ? 'selected' : '' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <input type="hidden" name="selesai" id="input_selesai">
        @if ($errors->has('selesai'))
            <div class="form-control-feedback">
                {{ $errors->first('selesai') }}
            </div>
        @endif
    </div>

    <div class="m-form__group form-group">
        <label for="">Status</label>
        <div>
            <span class="m-switch m-switch--icon">
                <label>
                    <input type="checkbox" {{ ($item->status ?? false) == true ? 'checked' : ''}} name="status">
                    <span></span>
                </label>
            </span>
        </div>
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
        $(document).ready(function() {
            setSelesaiAttr();

            $("#mulai").change(function() {
                setSelesaiAttr();
            });
        });

        function setSelesaiAttr()
        {
            var val = parseInt($("#mulai option:selected").val());
            $('#selesai').val(val + 5).trigger('change');
            $('#input_selesai').val(val + 5);
            if (val > 2094) {
                $('#selesai').val(2099).trigger('change');
                $('#input_selesai').val(2099);
            }
        }
    </script>
@endpush