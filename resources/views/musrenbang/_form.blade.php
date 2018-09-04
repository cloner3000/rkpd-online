{{ csrf_field() }}

<div class="m-portlet__body" style="padding-top:0px">
    <h5>Detail Kegiatan</h5>

    <div class="row form-group">
        <div class="col-md-6">
            <div class="form-group m-form__group {{ $errors->has('tahun') ? 'has-danger' : ''}}">
                <label>
                    Tahun Anggaran
                </label>
                <select class="form-control m-select2" id="m_select2_1" name="tahun">
                    <option disabled selected>-- Silahkan Pilih --</option>
                    @forelse(tahun_anggaran() as $ta)
                        <option {{ old('tahun') == $ta || ($item->tahun ?? 0 == $ta) ? 'selected' : '' }} value="{{ $ta }}">
                            {{ $ta }}
                        </option>
                    @empty
                        <option disabled>-- Tidak ada data --</option>
                    @endforelse
                </select>
                @if ($errors->has('tahun'))
                    <br>
                    <span class="form-control-feedback">
                        <strong>{{ $errors->first('tahun') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-form__group {{ $errors->has('sumber_anggaran') ? 'has-danger' : '' }}">
                <label>
                    Sumber Anggaran
                </label>
                <select class="form-control m-select2" id="m_select2_1" name="sumber_anggaran">
                    <option disabled selected>-- Silahkan Pilih --</option>
                    @forelse($sumberAnggarans as $anggaran)
                        <option {{ old('sumber_anggaran') == $anggaran->id || ($item->sumber_anggaran_id ?? 0 == $anggaran->id) ? 'selected' : '' }} value="{{ $anggaran->id }}">
                            {{ $anggaran->nama }}
                        </option>
                    @empty
                        <option disabled>-- Tidak ada data --</option>
                    @endforelse
                </select>
                @if ($errors->has('sumber_anggaran'))
                    <br>
                    <span class="form-control-feedback">
                        <strong>{{ $errors->first('sumber_anggaran') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama_kegiatan') ? ' has-danger ' : '' }} ">
        <label for="name">Nama Kegiatan</label>
        <div class="m-typeahead">
            <input type="text" class="form-control m-input m-typeahead" id="nama_kegiatan"
                   name="nama_kegiatan" value="{{ old('nama_kegiatan', $item->kegiatan->nama ?? '') }}">
            <input type="hidden" name="kegiatan" id="id_kegiatan_id" value="{{ old('kegiatan', $item->kegiatan->id ?? '') }}">
        </div>
        @if ($errors->has('nama_kegiatan'))
            <br>
            <span class="form-control-feedback">
                <strong>{{ $errors->first('nama_kegiatan') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group m-form__group">
        <label>Deskripsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="2" disabled readonly></textarea>
    </div>

    <div class="m-form__group form-group">
        <label>
            Status Kegiatan *
        </label>
        <div class="col-12">
            <div class="m-radio-inline">
                <label class="m-radio">
                    <input type="radio" name="status_kegiatan" value="1" disabled>
                    Baru
                    <span></span>
                </label>
                <label class="m-radio">
                    <input type="radio" name="status_kegiatan" value="2" checked>
                    Sedang Berjalan
                    <span></span>
                </label>
                <label class="m-radio">
                    <input type="radio" name="status_kegiatan" value="3" disabled>
                    Alternatif
                    <span></span>
                </label>
            </div>
        </div>
    </div>

    <hr>
    <h5>Indikator Hasil Program</h5>


    <div class="form-group row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('url') ? ' has-danger ' : '' }} m-form__group">
                <label>Tolak Ukur</label>
                <input type="text" class="form-control m-input" id="id_indikator_hasil_program" readonly disabled
                       name="url" value="{{ old('url', $item->url ?? '') }}">
                @if ($errors->has('url'))
                    <br>
                    <span class="form-control-feedback">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('url') ? ' has-danger ' : '' }} m-form__group">
                <label>Target</label>
                <input type="text" class="form-control m-input" id="id_indikator_hasil_program_target" disabled readonly
                       name="url" value="{{ old('url', $item->url ?? '') }}">
                @if ($errors->has('url'))
                    <br>
                    <span class="form-control-feedback">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group m-form__group">
                <label>
                    Satuan
                </label>
                <input type="text" class="form-control m-input" id="id_indikator_hasil_program_satuan" readonly
                       disabled>
            </div>
        </div>
    </div>
    <hr>
    <h5>Indikator Keluaran Kegiatan</h5>


    <div class="form-group row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('url') ? ' has-danger ' : '' }} m-form__group">
                <label>Tolak Ukur</label>
                <input type="text" class="form-control m-input" id="id_indikator_hasil" readonly disabled
                       name="url" value="{{ old('url', $item->url ?? '') }}">
                @if ($errors->has('url'))
                    <br>
                    <span class="form-control-feedback">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('target_kk') ? ' has-danger ' : '' }} m-form__group">
                <label>Target</label>
                <input type="text" class="form-control m-input" id=""
                       name="target_kk" value="{{ old('target_kk', $item->target_kk ?? '') }}">
                @if ($errors->has('target_kk'))
                    <br>
                    <span class="form-control-feedback">
                <strong>{{ $errors->first('target_kk') }}</strong>
            </span>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group m-form__group">
                <label>
                    Satuan
                </label>
                <input type="text" id="id_indikator_keluaran_kegiatan" class="form-control m-input" readonly disabled>
            </div>
        </div>
    </div>

    <hr>
    <h5>Indikator Hasil Kegiatan</h5>


    <div class="form-group row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('url') ? ' has-danger ' : '' }} m-form__group">
                <label>Tolak Ukur</label>
                <input type="text" class="form-control m-input" id="id_indikator_keluaran" readonly disabled
                       name="url" value="{{ old('url', $item->url ?? '') }}">
                @if ($errors->has('url'))
                    <br>
                    <span class="form-control-feedback">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('target_hk') ? ' has-danger ' : '' }} m-form__group">
                <label>Target</label>
                <input type="text" class="form-control m-input" id="url" id="id_hasil_kegiatan"
                       name="target_hk" value="{{ old('target_hk', $item->target_kk ?? '') }}">
                @if ($errors->has('target_hk'))
                    <br>
                    <span class="form-control-feedback">
                <strong>{{ $errors->first('target_hk') }}</strong>
            </span>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group m-form__group">
                <label>
                    Satuan
                </label>
                <input type="text" id="id_indikator_keluaran_satuan" class="form-control m-input" readonly disabled>
            </div>
        </div>
    </div>

    <hr>
    <h5>Lokasi Kegiatan</h5>

    <div class="form-group m-form__group {{ $errors->has('lokasi_kegiatan') ? 'has-danger' : '' }}">
        <label>
            Lokasi Kegiatan
        </label>
        <select class="form-control m-select2" id="lokasi_kegiatan" name="lokasi_kegiatan">
            <option disabled selected>-- Silahkan Pilih --</option>
            @forelse($jenisLokasi as $lok)
                <option {{ old('lokasi_kegiatan') == $lok->id || (($item->jenisLokasi->id ?? 0) == $lok->id) ? 'selected' : '' }} value="{{ $lok->id }}">
                    {{ $lok->nama }}
                </option>
            @empty
                <option disabled>-- Tidak ada data --</option>
            @endforelse
        </select>
    </div>

    <div class="form-group row" id="id_kecamatan">
        <div class="col-6">
            <div class="form-group m-form__group">
                <label>
                    Kecamatan *
                </label>
                <select class="form-control m-select2" id="select_district_2" name="kecamatan">
                    <option disabled selected>-- Silahkan Pilih --</option>
                    @forelse($districts as $district)
                        <option value="{{ $district->id }}">
                            {{ $district->name }}
                        </option>
                    @empty
                        <option disabled>-- Tidak ada data --</option>
                    @endforelse
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
        <label for="name">Tujuan Lokasi</label>
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
        <button type="button" class="btn btn-success" id="id_tambah_tujuan_lokasi"><i
                    class="fa fa-plus"></i> Tambah
        </button>
    </div>

    <div class="form-group m-form__group">
        <label>Lokasi Kegiatan</label>
        <textarea name="lokasi" id="lokasi" cols="30" rows="2"
                  class="form-control m-input">{{ old('lokasi', $item->lokasi ?? '') }}</textarea>
    </div>

    <div class="form-group m-form__group">
        <button type="button" id="id_hapus_lokasi" class="btn btn-default"><i class="fa fa-eraser"></i> Hapus</button>
    </div>

    <hr>
    <h5>Data Pendukung</h5>

    <div class="form-group m-form__group">
        <label>File TOR/KAK/RAB :</label>
        <input type="file" name="fileKak" class="form-control m-input">
    </div>

    <div class="form-group m-form__group">
        <label>Foto Keadaan Sekarang </label>
        <div class="row">
            <div class="col-lg-2">
                <div class="m-dropzone dropzone dz-clickable" action="{{ route('file.upload') }}"
                     id="m-dropzone-one">
                    <div class="m-dropzone__msg dz-message needsclick">
                        <h3 class="m-dropzone__msg-title">
                            Drop files here or click to upload.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        let district2 = $('#select_district_2');
        let village = $('#select_village');
        let $lokasiKegiatan = $('#lokasi_kegiatan');
        let $id_kecamatan = $('#id_kecamatan');
        let $id_tujuan_lokasi = $('#flag_tujuan_lokasi');

        let $tambahLokasi = $('#id_tambah_tujuan_lokasi');
        let $tujuanLokasi = $('#id_tujuan_lokasi');
        let $lokasi = $('#lokasi');
        let $btnHapus = $('#id_hapus_lokasi');

        district2.select2();
        village.select2();
        $lokasiKegiatan.select2();

        // initial hide
        $id_kecamatan.hide();

        $lokasiKegiatan.on('change', function () {
            if ($(this).val() == 3) {
                $id_kecamatan.show();
            } else {
                $id_kecamatan.hide();
            }
        });

        $tambahLokasi.on('click', function () {
            if ($lokasiKegiatan.val() !== 3) {
                let temp = $tujuanLokasi.val();
                let lokasi = $lokasi.val();
                lokasi += temp + '; ';
                // console.log(lokasi);
                $lokasi.val(lokasi);
                $tujuanLokasi.val('');
            }

        });

        $btnHapus.on('click', function () {
            $lokasi.val('');
            $tujuanLokasi.val('');
        });

        let url = "{{ route('location.villagegs', ':id')  }}";

        district2.on('change', function () {
            let newUrl = url.replace(':id', $(this).val());
            axios.get(newUrl, {type: 'Desa'})
                .then((res) => {

                    village
                        .empty()
                        .append('<option selected="selected" disabled>-- Silahkan Pilih --</option>');

                    village.select2({data: res.data}).trigger('change');

                    // manually trigger the `select2:select` event
                    village.trigger({
                        type: 'select2:select',
                        params: {
                            data: res.data
                        }
                    });


                }).catch((errors) => {
                // console.log(errors);
            })
        });

        let $kegiatan = $('#nama_kegiatan');
        $kegiatan.focus();
        let baseRoute = "{{ route('kegiatan.lookup', ':namaKegiatan') }}";

        //setup before functions
        let typingTimer;                //timer identifier
        let doneTypingInterval = 500;  //time in ms, 5 second for example


        // on keyup, start the countdown
        $kegiatan.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown
        $kegiatan.on('keydown', function () {
            clearTimeout(typingTimer);
        });

        // on leave get lookup kegiatan
        $kegiatan.on('blur', function () {
            let val = $(this).val();
            let route = "{{ route('kegiatan.lookup.data') }}";
            let deskripsi = $('#deskripsi');
            let $indikatorHasilProgram = $('#id_indikator_hasil_program');
            let $indikatorHasilProgramSatuan = $('#id_indikator_hasil_program_satuan');
            let $indikatorHasilProgramTarget = $('#id_indikator_hasil_program_target');
            let $indikatorKeluaranKegiatan = $('#id_indikator_hasil');
            let $indikatorKeluaranKegiatanSatuan = $('#id_indikator_keluaran_kegiatan');
            let $indikatorKeluaran = $('#id_indikator_keluaran');
            let $satuanKeluaran = $('#id_indikator_keluaran_satuan');
            let $kegiatanId = $('#id_kegiatan_id');

            if (val !== '') {
                axios.post(route, {keyword: val})
                    .then((res) => {
                        // console.log(res.data);
                        deskripsi.val(res.data.deskripsi);
                        $kegiatanId.val(res.data.id);

                        if (typeof (res.data.indikator_kegiatan) !== 'undefined') {
                            let indikator_kegiatan = res.data.indikator_kegiatan;
                            for (let i = 0; i < indikator_kegiatan.length; i++) {
                                if (indikator_kegiatan[i].indikator_hasil_id === 2) {
                                    $indikatorKeluaranKegiatan.val(indikator_kegiatan[i].tolak_ukur);
                                    $indikatorKeluaranKegiatanSatuan.val(indikator_kegiatan[i].satuan.nama);
                                }
                                if (indikator_kegiatan[i].indikator_hasil_id === 3) {
                                    $indikatorKeluaran.val(indikator_kegiatan[i].tolak_ukur);
                                    $satuanKeluaran.val(indikator_kegiatan[i].satuan.nama);
                                }
                            }
                        }

                        if (typeof(res.data.program !== 'undefined') && (res.data.program) && typeof(res.data.program.capaian_program !== 'undefined')) {
                            $indikatorHasilProgram.val(res.data.program.capaian_program[0].tolak_ukur);
                            $indikatorHasilProgramSatuan.val(res.data.program.capaian_program[0].satuan.nama);
                            $indikatorHasilProgramTarget.val(res.data.program.capaian_program[0].target);
                        }

                    })
                    .catch((error) => {
                        // console.log(error);
                    });
            }
        });

        //user is "finished typing," do something
        function doneTyping() {
            let keyqord = $('#nama_kegiatan').val();
            if (keyqord !== '') {
                lookupKegiatan(keyqord);
            }
        }

        var lookupKegiatan = function (keyword) {
            let routeKegiatan = baseRoute.replace(':namaKegiatan', keyword);
            var kegiatan = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: routeKegiatan
            });
            let $kegiatan = $('#nama_kegiatan');
            $kegiatan.typeahead(null, {
                name: 'kegiatan',
                source: kegiatan
            });
            $kegiatan.focus();

        };

    </script>
@endpush