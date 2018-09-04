{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('program') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Program</label>
        <select class="form-control m-select2" id="program" name="program">
            <option value="">-- Pilih Program --</option>
            @foreach($program as $key => $value)
                <option value="{{ $key }}"
                        {{ old('program') == $key || !empty($item) && $item->program_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('program'))
            <div class="form-control-feedback">
                {{ $errors->first('program') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('indikator_sasaran') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Indikator Sasaran</label>
        <select class="form-control m-select2" id="indikator_sasaran" name="indikator_sasaran">
            <option value="">-- Pilih Indikator Sasaran --</option>
            @foreach($indikator_sasaran as $key => $value)
                <option value="{{ $key }}"
                        {{ old('indikator_sasaran') == $key || !empty($item) && $item->indikator_sasaran_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('indikator_sasaran'))
            <div class="form-control-feedback">
                {{ $errors->first('indikator_sasaran') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('kode') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Kode</label>
        <input type="number" class="form-control form-control-danger m-input" id="name" placeholder="Masukan Kode"
               name="kode" value="{{ old('kode', $item->kode ?? '') }}" min="0">
        @if ($errors->has('kode'))
            <div class="form-control-feedback">
                {{ $errors->first('kode') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Kegiatan</label>
        <input type="text" class="form-control form-control-danger m-input" id="nama" placeholder="Masukan Nama"
               name="nama" value="{{ old('nama', $item->nama ?? '') }}">
        @if ($errors->has('nama'))
        <div class="form-control-feedback">
            {{ $errors->first('nama') }}
        </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('deskripsi') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Deskripsi</label>
        <input type="text" class="form-control form-control-danger m-input" id="deskripsi" placeholder="Masukan Deskripsi"
               name="deskripsi" value="{{ old('deskripsi', $item->deskripsi ?? '') }}">
        @if ($errors->has('deskripsi'))
            <div class="form-control-feedback">
                {{ $errors->first('deskripsi') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('keyword') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Keyword</label>
        <input type="text" class="form-control form-control-danger m-input" id="keyword" placeholder="Masukan Keyword"
               name="keyword" value="{{ old('keyword', $item->keyword ?? '') }}">
        @if ($errors->has('keyword'))
            <div class="form-control-feedback">
                {{ $errors->first('keyword') }}
            </div>
        @endif
    </div>
</div>

<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('footer.javascript')
    <script>
        $('#program').select2({
            placeholder: "Pilih Program"
        });
        $('#indikator_sasaran').select2({
            placeholder: "Pilih Indikator Sasaran"
        });
    </script>
@endpush