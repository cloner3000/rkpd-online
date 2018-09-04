{{ csrf_field() }}
<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('kode') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">KODE *</label>
        <input type="number" class="form-control form-control-danger m-input" id="kode" placeholder="Masukan Kode"
               name="kode" value="{{ old('kode', $item->kode ?? '') }}">
        @if ($errors->has('kode'))
            <div class="form-control-feedback">
                {{ $errors->first('kode') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('indikator_hasil') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Indikator Hasil *</label>
        <select class="form-control m-select2" id="indikator_hasil" name="indikator_hasil">
            <option value="">-- Pilih Indikator Hasil --</option>
            @foreach($indikatorHasils as $value)
                <option {{ (old('indikator_hasil') == $value->id) || ($item->indikatorHasil->id ?? false) == $value->id  ? 'selected' : ''  }} value="{{ $value->id }}">
                    {{ $value->nama }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('indikator_hasil'))
            <div class="form-control-feedback">
                {{ $errors->first('indikator_hasil') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('tolak_ukur') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Tolak Ukur *</label>
        <input type="text" class="form-control form-control-danger m-input" id="nama" placeholder="Masukan Tolak Ukur"
               name="tolak_ukur" value="{{ old('tolak_ukur', $item->tolak_ukur ?? '') }}">
        @if ($errors->has('tolak_ukur'))
            <div class="form-control-feedback">
                {{ $errors->first('tolak_ukur') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('satuan') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Satuan *</label>
        <select class="form-control m-select2" id="satuan" name="satuan">
            <option value="">-- Pilih Satuan --</option>
            @foreach($satuans as $value)
                <option {{ (old('satuan') == $value->id) || (($item->satuan->id ?? false) == $value->id)  ? 'selected' : ''  }} value="{{ $value->id }}">
                    {{ $value->nama }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('satuan'))
            <div class="form-control-feedback">
                {{ $errors->first('satuan') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('abs') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Analisi Standar Biaya *</label>
        <input type="number" class="form-control form-control-danger m-input" id="asb" placeholder="Masukan Analisis Standard Biaya"
               name="asb" value="{{ old('asb', $item->asb ?? '') }}">
        @if ($errors->has('asb'))
            <div class="form-control-feedback">
                {{ $errors->first('asb') }}
            </div>
        @endif
    </div>
</div>

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kegiatan.indikator-kegiatan.index', $id) }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#kegiatan').select2({
            placeholder: "Pilih Kegiatan"
        });
        $('#indikator_hasil').select2({
            placeholder: "Pilih Indikator Hasil"
        });
        $('#satuan').select2({
            placeholder: "Pilih Satuan"
        });

    </script>
@endpush