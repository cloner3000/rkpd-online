{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('name') ? ' has-danger ' : '' }} ">
        <label for="name">Nama Kelompok</label>
        <input type="text" class="form-control m-input" id="name"
               name="name" value="{{ old('name', $item->name ?? '') }}">
        @if ($errors->has('name'))
            <br>
            <span class="form-control-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>`

    {{--<div class="form-group{{ $errors->has('guard_name') ? ' has-danger ' : '' }} m-form__group">--}}
        {{--<label>Guard Name</label>--}}
        {{--<input type="text" class="form-control m-input" id="url"--}}
               {{--name="guard_name" value="{{ old('guard_name', $item->guard_name ?? '') }}">--}}
        {{--@if ($errors->has('guard_name'))--}}
            {{--<br>--}}
            {{--<span class="form-control-feedback">--}}
                {{--<strong>{{ $errors->first('guard_name') }}</strong>--}}
            {{--</span>--}}
        {{--@endif--}}
    {{--</div>--}}


</div>
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    </div>
</div>
