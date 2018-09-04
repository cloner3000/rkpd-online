{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('visi_id') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="visi">Visi</label>
        <select class="form-control m-input" id="visi_id" name="visi_id">
            <option value="">-- Pilih Visi --</option>
            @foreach($visi as $key => $value)
                <option value="{{ $key }}"
                        {{ old('visi_id') == $key || !empty($item) && $item->visi_id == $key ? 'selected' : '' ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('visi_id'))
            <div class="form-control-feedback">
                {{ $errors->first('visi_id') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('tahun') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Tahun</label>
        <select class="form-control m-input" id="tahun" name="tahun">
            @for($i=2016; $i<= 2099; $i++)
                <option value="{{ $i }}" {{ !empty($item) ? $i == $item->tahun ? 'selected' : '' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        @if ($errors->has('tahun'))
            <div class="form-control-feedback">
                {{ $errors->first('tahun') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Nama</label>
        <input type="text" class="form-control form-control-danger m-input" id="nama" placeholder="Masukan Nama"
               name="nama" value="{{ old('nama', $item->nama ?? '') }}">
        @if ($errors->has('nama'))
        <div class="form-control-feedback">
            {{ $errors->first('nama') }}
        </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('ibu_kota') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Ibu Kota</label>
        <input type="text" class="form-control form-control-danger m-input" id="ibu_kota" placeholder="Masukan Ibu Kota"
               name="ibu_kota" value="{{ old('ibu_kota', $item->ibu_kota ?? '') }}">
        @if ($errors->has('ibu_kota'))
            <div class="form-control-feedback">
                {{ $errors->first('ibu_kota') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('alamat') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Alamat</label>
        <input type="text" class="form-control form-control-danger m-input" id="alamat" placeholder="Masukan Alamat"
               name="alamat" value="{{ old('alamat', $item->alamat ?? '') }}">
        @if ($errors->has('alamat'))
            <div class="form-control-feedback">
                {{ $errors->first('alamat') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('logo') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Logo</label>
        <input type="file" class="form-control form-control-danger m-input" id="logo" placeholder="Logo" name="logo" multiple="multiple">
        @if ($errors->has('logo'))
            <div class="form-control-feedback">
                {{ $errors->first('logo') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama_kepala_daerah') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Nama Kepala daerah</label>
        <input type="text" class="form-control form-control-danger m-input" id="nama_kepala_daerah" placeholder="Masukan Nama Kepala Daerah"
               name="nama_kepala_daerah" value="{{ old('nama_kepala_daerah', $item->nama_kepala_daerah ?? '') }}">
        @if ($errors->has('nama_kepala_daerah'))
            <div class="form-control-feedback">
                {{ $errors->first('nama_kepala_daerah') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('jabatan_kepala_daerah') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Jabatan Kepala Daerah</label>
        <input type="text" class="form-control form-control-danger m-input" id="jabatan_kepala_daerah" placeholder="Masukan Jabatan Kepala Daerah"
               name="jabatan_kepala_daerah" value="{{ old('jabatan_kepala_daerah', $item->jabatan_kepala_daerah ?? '') }}">
        @if ($errors->has('jabatan_kepala_daerah'))
            <div class="form-control-feedback">
                {{ $errors->first('jabatan_kepala_daerah') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nama_sekda') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Nama Sekda</label>
        <input type="text" class="form-control form-control-danger m-input" id="nama_sekda" placeholder="Masukan Nama Sekda"
               name="nama_sekda" value="{{ old('nama_sekda', $item->nama_sekda ?? '') }}">
        @if ($errors->has('nama_sekda'))
            <div class="form-control-feedback">
                {{ $errors->first('nama_sekda') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('nip_sekda') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">NIP Sekda</label>
        <input type="text" class="form-control form-control-danger m-input" id="nip_sekda" placeholder="Masukan Nip Sekda"
               name="nip_sekda" value="{{ old('nip_sekda', $item->nip_sekda ?? '') }}">
        @if ($errors->has('nip_sekda'))
            <div class="form-control-feedback">
                {{ $errors->first('nip_sekda') }}
            </div>
        @endif
    </div>

    <div class="form-group m-form__group {{ $errors->has('jabatan_sekda') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="inputDanger1">Jabatan Sekda</label>
        <input type="text" class="form-control form-control-danger m-input" id="jabatan_sekda" placeholder="Masukan Jabatan Sekda"
               name="jabatan_sekda" value="{{ old('jabatan_sekda', $item->jabatan_sekda ?? '') }}">
        @if ($errors->has('jabatan_sekda'))
            <div class="form-control-feedback">
                {{ $errors->first('jabatan_sekda') }}
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