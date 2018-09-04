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
    <div class="form-group m-form__group row {{ $errors->has('old') ? ' has-danger' : '' }}">
        <label for="example-text-input" class="col-2 col-form-label">
            Kata Kunci Lama
        </label>
        <div class="col-5">
            <input type="password" name="old" id="old" class="form-control m-input" value="">
            @if ($errors->has('old'))
                <div class="form-control-feedback">
                    {{ $errors->first('old') }}
                </div>
            @endif
        </div>

    </div>
    <div class="form-group m-form__group row {{ $errors->has('new') ? ' has-danger' : '' }}">
        <label for="example-text-input" class="col-2 col-form-label">
            Kata Kunci Baru
        </label>
        <div class="col-5">
            <input type="password" name="new" id="new" class="form-control m-input" value="" placeholder="Minimal 6 Karakter..">
            @if ($errors->has('new'))
                <div class="form-control-feedback">
                    {{ $errors->first('new') }}
                </div>
            @endif
        </div>
    </div>
    <div class="form-group m-form__group row {{ $errors->has('new_confirmation') ? ' has-danger' : '' }}">
        <label for="example-text-input" class="col-2 col-form-label">
            Konfirmasi Kata Sandi
        </label>
        <div class="col-5">
            <input type="password" name="new_confirmation" id="new_confirmation" class="form-control m-input" value="">
            @if ($errors->has('new_confirmation'))
                <div class="form-control-feedback">
                    {{ $errors->first('new_confirmation') }}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-7">
                <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                    Simpan
                </button>
                &nbsp;&nbsp;
                <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>