<div class="form-group m-form__group {{ $errors->has('lokasi_kegiatan') ? 'has-danger' : '' }}">
    <label>
        Jenis Lokasi
    </label>
    <select class="form-control m-select2" id="lokasi_kegiatan" readonly disabled>
        <option selected value="3">{{ \App\Enum\Lokasi::KECAMATAN }}</option>
    </select>
    <input type="hidden" value="3" name="lokasi_kegiatan">
</div>

@php
    $district   = get_district($user->opd->first()->kode ?? null);
    $desa       = get_village($user->opd->first()->kode ?? null);
@endphp

<div class="form-group row">
    @if($district)
        <div class="col-6">
            <div class="form-group m-form__group">
                <label>
                    Kecamatan *
                </label>
                <select class="form-control m-select2" id="select_district_2" name="kecamatan" readonly disabled>
                    <option disabled selected value="{{ $district->id }}">{{ $district->name  }}</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group m-form__group">
                <label>
                    Desa / Kelurahan
                </label>
                <select class="form-control m-select2" id="select_village" name="desa" disabled>
                    @foreach($district->villages as $village)
                        <option value="{{ $village->id }}">{{ $village->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @elseif($desa)
        <div class="col-6">
            <div class="form-group m-form__group">
                <label>
                    Kecamatan *
                </label>
                <select class="form-control m-select2" id="select_district_2" name="kecamatan" readonly disabled>
                    <option disabled selected
                            value="{{ $desa->district->id }}">{{ $desa->district->name  }}</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group m-form__group">
                <label>
                    Desa / Kelurahan
                </label>
                <select class="form-control m-select2" name="desa" disabled>
                    <option selected disabled value="{{ $desa->id }}">{{ $desa->name }}</option>
                </select>
            </div>
        </div>
    @endif
</div>

<div class="form-group m-form__group {{ $errors->has('tujuan_lokasi') ? ' has-danger ' : '' }} "
     id="flag_tujuan_lokasi">
    <label for="name">Alamat</label>
    <input type="text" class="form-control m-input" id="id_tujuan_lokasi"
           name="tujuan_lokasi" value="{{ old('tujuan_lokasi') }}">
    @if ($errors->has('tujuan_lokasi'))
        <br>
        <span class="form-control-feedback">
                <strong>{{ $errors->first('tujuan_lokasi') }}</strong>
            </span>
    @endif
</div>

<div class="form-group m-form__group">
    <button type="button" class="btn btn-success" id="id_tambah_tujuan_lokasi_desa"><i
                class="fa fa-plus"></i> Tambah
    </button>
    <button type="button" id="id_hapus_lokasi" class="btn btn-default"><i class="fa fa-eraser"></i> Hapus</button>
</div>

<div class="form-group m-form__group {{ $errors->has('lokasi') ? 'has-danger' : '' }}">
    <label>Lokasi Kegiatan *</label>
    <textarea name="lokasi" id="lokasi" cols="30" rows="2" readonly
              class="form-control m-input">{{ old('lokasi', $item->lokasi ?? '') }}</textarea>
    @if ($errors->has('lokasi'))
        <span class="form-control-feedback">
                        <strong>{{ $errors->first('lokasi') }}</strong>
                    </span>
    @endif
</div>
<hr>

@push('footer.javascript')
    <script>
        var $lokasiDesa = $('#id_tambah_tujuan_lokasi_desa');
        var $tujuanLokasiDesa = $('#id_tujuan_lokasi');
        var $btnHapusDesa = $('#id_hapus_lokasi');
        var $lokasi = $('#lokasi');
        var $tujuanLokasi = $('#id_tujuan_lokasi');

        $lokasiDesa.on('click', function () {
            var kecamatan = "{{ $district->name ?? false }}";
            var desa = "{{ $desa->name ?? false }}";
            if (desa) {
                kecamatan = "{{ $desa->district->name ?? false }}";
            } else {
                desa = $('#select_village :selected').text();
            }
            var temp = $tujuanLokasiDesa.val();
            var lokasi = $lokasi.val();
            lokasi += 'Kecamatan: ' + kecamatan + ', Desa/Kelurahan: ' + desa + '. ' + temp + '; ';
            $lokasi.val(lokasi);
            $tujuanLokasi.val('');

        });

        $btnHapusDesa.on('click', function () {
            $lokasi.val('');
            $tujuanLokasi.val('');
        });
    </script>
@endpush