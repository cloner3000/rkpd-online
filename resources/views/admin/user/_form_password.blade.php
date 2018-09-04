{{ csrf_field() }}
<div class="m-portlet__body">
    <div class="col-md-12">
        @if (!empty(session('alert')['password']))
            @include('global.notif_action', [
                'type'    => session('alert')['type'],
                'alert'   => session('alert')['alert'],
                'message' => session('alert')['message']
            ])
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('new') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Kata Kunci Baru</label>
        <input type="password" class="form-control form-control-danger m-input" id="new" placeholder="Masukan kata kunci baru"
               name="new">
        @if ($errors->has('new'))
            <div class="form-control-feedback">
                {{ $errors->first('new') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('new_confirmation') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Konfirmasi Kata Kunci</label>
        <input type="password" class="form-control form-control-danger m-input" id="new_confirmation" placeholder="Masukan kembali kata kunci"
               name="new_confirmation">
        @if ($errors->has('new_confirmation'))
            <div class="form-control-feedback">
                {{ $errors->first('new_confirmation') }}
            </div>
        @endif
    </div>
</div>

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>