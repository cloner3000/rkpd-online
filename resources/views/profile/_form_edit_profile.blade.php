{{ csrf_field() }}
<div class="m-portlet__body">
    <div class="col-md-12">
        @if (!empty(session('alert')['profile']))
            @include('global.notif_action', [
                'type'    => session('alert')['type'],
                'alert'   => session('alert')['alert'],
                'message' => session('alert')['message']
            ])
        @endif
    </div>
    <div class="form-group m-form__group row">
        <label for="example-text-input" class="col-2 col-form-label">
        </label>
        <div class="col-2">
            <div class="m-card-profile">
                <div class="m-card-profile__pic">
                    @if (!empty(auth()->user()->ImageUrl))
                        <div class="m-card-profile__pic-wrapper">
                            <img src="{{ auth()->user()->ImageUrl }}" alt="">
                        </div>
                    @else
                        <i class="flaticon-profile-1 m--icon-font-size-lg5"></i>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="example-text-input" class="col-2 col-form-label">
        </label>
        <div class="col-5">
            <input type="file" class="form-control m-input" id="photo" placeholder="Photo" name="photo">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="example-text-input" class="col-2 col-form-label">
            Nama Lengkap
        </label>
        <div class="col-5">
            <input class="form-control m-input" type="text" value="{{ $user->nama_lengkap }}">
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="example-text-input" class="col-2 col-form-label">
            Username
        </label>
        <div class="col-5">
            <input class="form-control m-input" type="text" value="{{ $user->name }}" readonly>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="example-text-input" class="col-2 col-form-label">
            Email
        </label>
        <div class="col-5">
            <input class="form-control m-input" type="text" value="{{ $user->email }}" name="email">
        </div>
    </div>
    <div class="form-group m-form__group row {{ $errors->has('alamat') ? ' has-danger' : '' }}">
        <label for="example-text-input" class="col-2 col-form-label">
            Alamat
        </label>
        <div class="col-5">
            <textarea class="form-control m-input" rows="5" name="alamat">{{ $user->alamat }}</textarea>
            @if ($errors->has('alamat'))
                <div class="form-control-feedback">
                    {{ $errors->first('alamat') }}
                </div>
            @endif
        </div>
    </div>
    <div class="form-group m-form__group row {{ $errors->has('no_hp') ? ' has-danger' : '' }}">
        <label for="example-text-input" class="col-2 col-form-label">
            No. Hp
        </label>
        <div class="col-5">
            <input class="form-control m-input" type="text" value="{{ $user->no_hp }}" name="no_hp">
            @if ($errors->has('no_hp'))
                <div class="form-control-feedback">
                    {{ $errors->first('no_hp') }}
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