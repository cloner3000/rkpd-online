{{ csrf_field() }}
<div class="form-group m-form__group {{ $errors->has('email') ? ' has-danger' : '' }}">
    <input class="form-control m-input" type="email" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}">
    @if ($errors->has('email'))
        <div class="form-control-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>
<div class="form-group m-form__group {{ $errors->has('password') ? ' has-danger' : '' }}">
    <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Kata Sandi" name="password">
    @if ($errors->has('password'))
        <div class="form-control-feedback">
            {{ $errors->first('password') }}
        </div>
    @endif
</div>
<div class="row m-login__form-sub">
    <div class="col m--align-left">
        <label class="m-checkbox m-checkbox--focus">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            Ingat Saya
            <span></span>
        </label>
    </div>
    <div class="col m--align-right">
        <a href="#" id="m_login_forget_password" class="m-link">
            Lupa Kata Sandi ?
        </a>
    </div>
</div>
<div class="m-login__form-action">
    <button id="m_login_signin_submit" type="submit" class="btn btn-warning m-btn m-btn--pill m-btn--custom m-btn--air">
        Masuk
    </button>
</div>