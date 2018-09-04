{{ csrf_field() }}
<input type="hidden" name="token" id="token_reset_password" value="{{ $token ?? '' }}">

<div class="form-group m-form__group {{ $errors->has('email') ? ' has-danger' : '' }}">
    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="email" autocomplete="off"
           value="{{ $email ?? old('email') }}">
    @if ($errors->has('email'))
        <div class="form-control-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>

<div class="form-group m-form__group {{ $errors->has('password') ? ' has-danger' : '' }}">
    <input class="form-control m-input" type="password" placeholder="Password" name="password">
    @if ($errors->has('password'))
        <div class="form-control-feedback">
            {{ $errors->first('password') }}
        </div>
    @endif
</div>

<div class="form-group m-form__group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="password_confirmation">
    @if ($errors->has('password'))
        <div class="form-control-feedback">
            {{ $errors->first('password_confirmation') }}
        </div>
    @endif
</div>

<div class="m-login__form-action">
    <button class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--air" type="submit">
        Kirim
    </button>
    <a href="{{ route('home') }}" class="btn btn-outline-warning  m-btn m-btn--pill m-btn--custom">
        Batal
    </a>
</div>