<div class="col-md-12">
    @if (session('alert'))
        @include('global.notif_action', [
            'type'    => session('alert')['type'],
            'alert'   => session('alert')['alert'],
            'message' => session('alert')['message']
        ])
    @endif
</div>

{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('name') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Username</label>
        <input type="text" class="form-control form-control-danger m-input" id="name" placeholder="Masukan Username"
               name="name" value="{{ old('name', $item->name ?? '') }}">
        @if ($errors->has('name'))
        <div class="form-control-feedback">
            {{ $errors->first('name') }}
        </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('email') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Email</label>
        <input type="text" class="form-control form-control-danger m-input" id="email" placeholder="Masukan Email"
               name="email" value="{{ old('email', $item->email ?? '') }}">
        @if ($errors->has('email'))
            <div class="form-control-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama_lengkap') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Nama Lengkap</label>
        <input type="text" class="form-control form-control-danger m-input" id="nama_lengkap" placeholder="Masukan Nama Lengkap"
               name="nama_lengkap" value="{{ old('nama_lengkap', $item->nama_lengkap ?? '') }}">
        @if ($errors->has('nama_lengkap'))
            <div class="form-control-feedback">
                {{ $errors->first('nama_lengkap') }}
            </div>
        @endif
    </div>

    @if(request()->route()->getName() === 'user.create')
        <div class="form-group m-form__group {{ $errors->has('password') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="inputDanger1">Kata Sandi</label>
            <input type="password" class="form-control form-control-danger m-input" id="password" name="password"
                   placeholder="Masukan Kata Sandi {{ !empty($item) ? "Baru" : '' }}">
            @if ($errors->has('password'))
                <div class="form-control-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <div class="form-group m-form__group">
            <label for="exampleInputPassword1">Ulangi Kata Sandi</label>
            <input id="password_confirm" type="password" class="form-control m-input"
                   placeholder="Ulangi Kata Sandi" name="password_confirmation">
        </div>
    @endif

    <div class="form-group m-form__group {{ $errors->has('role') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1"> Kelompok Pengguna</label>
        <select class="form-control m-select2" id="role" name="role">
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $key => $value)
                <option value="{{ $key }}" {{ old('role') == $key || (!empty($item) && !empty($user_role) && $user_role->id == $key) ? 'selected' : '' ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
        @if ($errors->has('role'))
            <div class="form-control-feedback">
                {{ $errors->first('role') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('opd') ? ' has-danger' : '' }}" style="display: {{ (!empty($item->opd) && $item->opd->first()) ? $item->opd->first()->id ? 'block' : 'none' : 'none' }}" id="div-jenis">
        <label class="form-control-label" for="inputDanger1"> Organisasi Perangkat Daerah (OPD)</label>
        <select class="form-control m-select2" id="opd" name="opd">
            <option value="">-- Pilih Opd --</option>
            @if(!empty($jenis_opd))
                @forelse($jenis_opd->opd as $key => $value)
                    <option value="{{ $value->id }}" {{ old('opd') == $key || (!empty($item) && !empty($opd) && $opd->id == $value->id) ? 'selected' : '' ? 'selected' : '' }}>{{ $value->fullName }}</option>
                @endforeach
            @endif
        </select>
        @if ($errors->has('opd'))
            <div class="form-control-feedback">
                {{ $errors->first('opd') }}
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
    <script>

        $(document).ready(function() {

            let role = $('#role');
            if (role.val() !== undefined || rolerole.val() !== empty) {
                getOpd(role);
            }
            $('#opd').select2({
                placeholder: "Pilih Opd"
            });
            role.select2({
                placeholder: "Pilih Role"
            });
            role.on('change', function() {
                getOpd(this);
            });
        });

        function getOpd(e) {
            let jenis = $('option:selected', e).text();
            let opd =  $('#opd');
            axios.post("{{ route('api.user.opd') }}", {'jenis': jenis})
                .then(function (response) {
                    opd.children('option').remove();
                    opd.append($('<option>', {
                        value: '',
                        text : '-- Pilih OPD --'
                    }));
                    $.each(response.data, function (i, item) {
                        $('#opd').append($('<option>', {
                            value: item.id,
                            text : item.nama
                        }));
                    });

                    $('#div-jenis').show();
                    opd.select2({
                        placeholder: "-- Pilih OPD --",
                    });
                })
                .catch(function (error) {
                    $('#div-jenis').hide();
                    opd.children('option').remove();
                });
        }
    </script>
@endpush