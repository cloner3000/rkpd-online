{{ csrf_field() }}
<div class="form-group m-form__group {{ $errors->has('email') ? ' has-danger' : '' }}">
    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="email" autocomplete="off"
           value="{{ old('email') }}">
    @if ($errors->has('email'))
        <div class="form-control-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>
<div class="m-login__form-action">
    <button class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--air" type="submit" id="">
        Kirim
    </button>
    <button id="m_login_forget_password_cancel" class="btn btn-outline-warning m-btn m-btn--pill m-btn--custom">
        Batal
    </button>
</div>
{{--{{ dd($errors) }}--}}
@if ($errors->has('forget'))
    <input type="hidden" id="forget">
@endif