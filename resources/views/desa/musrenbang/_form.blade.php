{{ csrf_field() }}
@php($user = auth()->user())
<div class="m-portlet__body" style="padding-top:0px">
    <h5>Detail Kegiatan</h5>

    <div class="row form-group">
        <div class="col-md-6">
            <div class="form-group m-form__group {{ $errors->has('tahun') ? 'has-danger' : ''}}">
                <label>
                    Tahun Anggaran
                </label>
                <select class="form-control m-select2" id="m_select2_1" disabled>
                    <option value="{{ $item->tahun ?? (Carbon\Carbon::now()->year + 1)  }}">{{ $item->tahun ?? (Carbon\Carbon::now()->year + 1)  }}</option>
                </select>
                <input type="hidden" name="tahun" value="{{ $item->tahun ?? (Carbon\Carbon::now()->year +1)  }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group m-form__group {{ $errors->has('sumber_anggaran') ? 'has-danger' : '' }}">
                @if(if_route_pattern(['musrenbang-desa.*', 'musrenbang-kelurahan.*']))
                    <label>Sumber Anggaran</label>
                    <select class="form-control m-select2" id="m_select2_1" name="sumber_anggaran" required>
                        @foreach ($sumberAnggarans as $anggaran)
                            <!-- <option value="{{ $anggaran->id  }}" {{ (old('sumber_anggaran') == $anggaran->id) || (($item->sumberAnggaran->id ?? false) == $anggaran->id) ? 'selected' : '' }} >
                                {{ $anggaran->nama }}
                            </option> -->
                            @if($anggaran->id == 3)
                            <option value="{{ $anggaran->id  }}" selected>
                                {{ $anggaran->nama }}
                            </option>
                            @endif
                        @endforeach
                    </select>
                @else
                    <label>
                        Sumber Anggaran
                    </label>
                    <select class="form-control m-select2" id="m_select2_1" name="sumber_anggaran">
                        <option disabled selected>-- Silahkan Pilih --</option>
                        @forelse($sumberAnggarans as $anggaran)
                            <option {{ old('sumber_anggaran') == $anggaran->id || (($item->sumber_anggaran_id ?? false) == $anggaran->id) ? 'selected' : '' }} value="{{ $anggaran->id }}">
                                {{ $anggaran->nama }}
                            </option>
                        @empty
                            <option disabled>-- Tidak ada data --</option>
                        @endforelse
                    </select>
                @endif

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
        <select class="form-control m-select2" id="nama_kegiatan" name="nama_kegiatan">
            <option value="{{ $item->kegiatan->id ?? '' }}" selected>{{ $item->kegiatan->nama ?? '' }}</option>
        </select>
    </div>
    @if ($errors->has('nama_kegiatan'))
        <br>
        <span class="form-control-feedback">
                <strong>{{ $errors->first('nama_kegiatan') }}</strong>
            </span>
    @endif
</div>

<div class="form-group m-form__group">
    <label>Catatan</label>
    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="2" disabled readonly>{{ $item->kegiatan->catatan ?? '' }}</textarea>
</div>

<hr>
<h5>Indikator Keluaran Kegiatan</h5>


<div class="form-group" id="indikator_container">
    @if(isset($item))
        @foreach ($item->targetAnggaran as $target)
            @if ($target->indikatorKegiatan->indikatorHasil->id == 2)
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group m-form__group">
                            <label>Tolak Ukur</label>
                            <input type="text" class="form-control m-input"
                                   value="{{ $target->indikatorKegiatan->tolak_ukur }}" readonly disabled>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group m-form__group">
                            <label>Target</label>
                            <input type="number" min="0" step="0.01"
                                   name="target_indikator_kegiatan[{{ $target->indikatorKegiatan->id }}]"
                                   class="form-control m-input"
                                   value="{{ $target->target }}" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group m-form__group">
                            <label>Satuan</label>
                            <input type="text" value="{{ $target->indikatorKegiatan->satuan->nama }}"
                                   class="form-control m-input" readonly disabled>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group m-form__group clearfix">
                            <label class="clearfix">
                            </label>
                            <button type="button" title="Hapus"
                                    class="indikator-remove m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                <i class="la la-trash"></i></button>
                        </div>
                    </div>
                </div></br>
            @endif
        @endforeach
    @endif
</div>

<div id="hasil_container"></div>

<hr>
<h5>Lokasi Kegiatan</h5>

@if($user->hasRole(\App\Enum\Roles::DESA))
    @include('musrenbang.lokasi._desa')
@endif


<div class="form-group row" id="id_kecamatan">
    <div class="col-6">
        <div class="form-group m-form__group">
            <label>
                Kecamatan *
            </label>
            <select class="form-control" id="select_district_2" name="kecamatan">
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

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        var district2 = $('#select_district_2');
        var village = $('#select_village');
        var $lokasiKegiatan = $('#lokasi_kegiatan');
        var $id_kecamatan = $('#id_kecamatan');

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

        var url = "{{ route('location.villagegs', ':id')  }}";

        district2.on('change', function () {
            var newUrl = url.replace(':id', $(this).val());
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

        var $kegiatan = $('#nama_kegiatan');
        $kegiatan.focus();
        var baseRoute = "{{ route('kegiatan.lookup', ':namaKegiatan') }}";


        function formatRepo(repo) {
            if (repo.loading) return repo.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.full_name + "</div></div></div>";
            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }

        $kegiatan.select2({
            placeholder: "Masukan nama kegiatan atau keyword",
            allowClear: false,
            ajax: {
                url: "{{ route('kegiatan.lookup') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: false
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // var our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        // on leave get lookup kegiatan
        $kegiatan.on('change', function () {
            // console.log('Lookup data by kegiatan');
            var val = $(this).val();
            var route = "{{ route('kegiatan.lookup.data') }}";
            var deskripsi = $('#deskripsi');
            var $indikatorHasilProgram = $('#id_indikator_hasil_program');
            var $indikatorHasilProgramSatuan = $('#id_indikator_hasil_program_satuan');
            var $indikatorHasilProgramTarget = $('#id_indikator_hasil_program_target');
            var $kegiatanId = $('#id_kegiatan_id');
            var $indikatorContainer = $('#indikator_container');
            var $hasilContainer = $('#hasil_container');

            if (val !== '') {
                axios.post(route, {keyword: val})
                    .then((res) => {
                        deskripsi.val(res.data.deskripsi);
                        $kegiatanId.val(res.data.id);

                        if (res.data.indikator_kegiatan.length > 0) {
                            // console.log('DAPET INDIKATOR KEGIATAN');
                            var countKeluaran = 0;
                            var countHasil = 0;
                            $indikatorContainer.empty();
                            $hasilContainer.empty();
                            for (var i = 0; i < res.data.indikator_kegiatan.length; i++) {
                                // console.log('MASUK LOOPING');
                                // console.log(res.data.indikator_kegiatan[i].indikator_hasil);
                                if (res.data.indikator_kegiatan[i].indikator_hasil.id == 2) {
                                    // console.log('FETCH TARGET KK');
                                    // console.log(res.data.indikator_kegiatan[i]);
                                    countKeluaran++;
                                    var template = '<div class="row">\n' +
                                        '        <div class="col-lg-6">\n' +
                                        '            <div class="form-group m-form__group">\n' +
                                        '                <label>Tolak Ukur</label>\n' +
                                        '                <input type="text" class="form-control m-input" value="' + res.data.indikator_kegiatan[i].tolak_ukur + '" readonly disabled>\n' +
                                        '            </div>\n' +
                                        '        </div>\n' +
                                        '        <div class="col-lg-3">\n' +
                                        '            <div class="form-group m-form__group">\n' +
                                        '                <label>Target</label>\n' +
                                        '                <input type="number" min="0" step="0.01" name="target_indikator_kegiatan[' + res.data.indikator_kegiatan[i].id + ']" class="form-control m-input numeric-input" min="0" required>\n' +
                                        '            </div>\n' +
                                        '        </div>\n' +
                                        '        <div class="col-lg-2">\n' +
                                        '            <div class="form-group m-form__group">\n' +
                                        '                <label>\n' +
                                        '                    Satuan\n' +
                                        '                </label>\n' +
                                        '                <input type="text" value="' + res.data.indikator_kegiatan[i].satuan.nama + '" class="form-control m-input" readonly disabled>\n' +
                                        '            </div>\n' +
                                        '        </div>\n';

                                    // if (countKeluaran > 1) {
                                    template += '        <div class="col-lg-1">\n' +
                                        '            <div class="form-group m-form__group clearfix">\n' +
                                        '                <label class="clearfix">\n' +
                                        '                </label>\n' +
                                        '                <button type="button" title="Hapus" \n' +
                                        '                        class="indikator-remove m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">\n' +
                                        '                    <i class="la la-trash"></i></button>\n' +
                                        '            </div>\n' +
                                        '        </div>\n';
                                    // }
                                    template += '</div></br>';
                                    $indikatorContainer.append(template);
                                }
                                if (res.data.indikator_kegiatan[i].indikator_hasil.id == 3) {
                                    // console.log('FETCH TARGET KH');
                                    // console.log(res.data.indikator_kegiatan[i]);
                                    countHasil++;
                                    var templateHasil = '<input type="hidden" class="form-control m-input" name="target_indikator_hasil[' + res.data.indikator_kegiatan[i].id + ']" value="0"></div>';
                                    $hasilContainer.append(templateHasil);
                                }
                            }
                        }

                        if ((res.data.program.length > 0) && (res.data.program) && (res.data.program.capaian_program.length > 0)) {
                            // console.log('FETCH CAPAIAN PROGRAM');
                            // console.log(res.data.program.capaian_program[0]);
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

        $('#indikator_container').on('click', '.indikator-remove', function () {
            $(this).closest('.row').remove();
        });

        $('#hasil_container').on('click', '.indikator-remove', function () {
            $(this).closest('.row').remove();
        });


        $(".numeric_only").keydown(function (e) {
            console.log('pushed');
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl/cmd+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: Ctrl/cmd+C
                (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: Ctrl/cmd+X
                (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });


    </script>
@endpush