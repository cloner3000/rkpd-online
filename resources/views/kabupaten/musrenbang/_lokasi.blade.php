<div class="form-group m-form__group {{ $errors->has('lokasi_kegiatan') ? 'has-danger' : '' }}">
    <label>
        Jenis Lokasi
    </label>
    <select class="form-control m-select2" id="lokasi_kegiatan_awal" name="lokasi_kegiatan">
        @foreach ($jenisLokasi as $lokasi)
            <option {{ (old('lokasi_kegiatan', 3) == $lokasi->id) || (($item->lokasiKegiatan->id ?? null) == $lokasi->id) ? 'selected' : '' }} value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
        @endforeach
    </select>
</div>

<div class="form-group row" id="flag_kecamatan_awal">
    <div class="col-6">
        <div class="form-group m-form__group">
            <label>
                Kecamatan *
            </label>
            <select class="form-control m-select2" id="select_district_2" name="kecamatan">
                <option disabled selected>-- Silahkan Pilih --</option>
                @foreach($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group m-form__group">
            <label>
                Desa / Kelurahan
            </label>
            <select class="form-control m-select2" id="select_village" name="desa">
                <option disabled selected>-- Silahkan Pilih --</option>
            </select>
        </div>
    </div>
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
        $('#select_district_2').select2();
        $('#select_village').select2();
        var $flagKecamatan = $('#flag_kecamatan_awal');
        var $lokasiKegiatan = $('#lokasi_kegiatan_awal');

        $lokasiKegiatan.select2();

        var $lokasiDesa = $('#id_tambah_tujuan_lokasi_desa');
        var $tujuanLokasiDesa = $('#id_tujuan_lokasi');
        var $btnHapusDesa = $('#id_hapus_lokasi');
        var $lokasi = $('#lokasi');
        var $tujuanLokasi = $('#id_tujuan_lokasi');

        $lokasiKegiatan.on('change', function () {
            if ($(this).val() == 3) {
                $flagKecamatan.show();
            } else {
                $flagKecamatan.hide();
            }
        });

        if ($('#lokasi_kegiatan_awal :selected').val() == 3) {
            $flagKecamatan.show();
        } else {
            $flagKecamatan.hide();
        }

        $lokasiDesa.on('click', function () {
            var kecamatan = $('#select_district_2 :selected').text();
            var desa = $('#select_village :selected').text();
            var temp = $tujuanLokasiDesa.val();
            var lokasi = $lokasi.val();

            if ($('#lokasi_kegiatan_awal :selected').val() == 3) {
                lokasi += 'Kecamatan: ' + kecamatan + ', Desa/Kelurahan: ' + desa + '. ' + temp + '; ';
            } else {
                lokasi += temp + '; ';
            }
            $lokasi.val(lokasi);
            $tujuanLokasi.val('');

        });

        $btnHapusDesa.on('click', function () {
            $lokasi.val('');
            $tujuanLokasi.val('');
        });
    </script>
@endpush