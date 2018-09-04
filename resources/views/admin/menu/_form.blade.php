{{ csrf_field() }}

<div class="m-portlet__body">
    <div class="form-group m-form__group {{ $errors->has('nama') ? ' has-danger ' : '' }} ">
        <label for="name">Nama</label>
        <input type="text" class="form-control m-input" id="name" aria-describedby="emailHelp"
               name="nama" value="{{ old('nama', $item->nama ?? '') }}">
        @if ($errors->has('nama'))
            <br>
            <span class="form-control-feedback">
                <strong>{{ $errors->first('nama') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('url') ? ' has-danger ' : '' }} m-form__group">
        <label>URL</label>
        <input type="text" class="form-control m-input" id="url"
               name="url" value="{{ old('url', $item->url ?? '') }}">
        @if ($errors->has('url'))
            <br>
            <span class="form-control-feedback">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('urutan') ? ' has-danger' : '' }} m-form__group">
        <label>Urutan</label>
        <input type="text" class="form-control m-input" id="url" name="urutan"
               value="{{ old('urutan', $item->urutan ?? '') }}">
        @if ($errors->has('urutan'))
            <br>
            <span class="form-control-feedback">
                <strong>{{ $errors->first('urutan') }}</strong>
            </span>
        @endif
    </div>


    <div class="form-group{{ $errors->has('icon') ? ' has-danger' : '' }} m-form__group">
        <label for="exampleInputicon1">Icon</label>
        <input type="text" class="form-control m-input" id="icon"
               value="{{ old('icon', $item->icon ?? '') }}" name="icon">
        @if ($errors->has('icon'))
            <br>
            <span class="form-control-feedback">
                <strong>{{ $errors->first('icon') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group m-form__group">
        <label for="exampleSelect1">
            Parent
        </label>
        <select class="form-control m-input m-input--square" name="parent_id" id="parent_id">
            <option {{ ($item->parrent_id ?? false) != null ? 'selected' : ''}} value="">-- Silahkan Pilih --</option>
            @forelse($menus as $menu)
                <option value="{{ $menu->id }}" {{ $menu->id == ($item->parrent_id ?? false) ? 'selected' : '' }}>{{ $menu->nama }}</option>
            @empty
                <option disabled>Tidak ada data</option>
            @endforelse
        </select>
    </div>

    <div class="form-group{{ $errors->has('level') ? ' has-danger' : '' }} m-form__group">
        <label for="exampleInputicon1">Level</label>
        <input type="text" class="form-control m-input" id="level"
               value="{{ old('level', $item->level ?? '') }}" name="level">
        @if ($errors->has('level'))
            <br>
            <span class="form-control-feedback">
                <strong>{{ $errors->first('level') }}</strong>
            </span>
        @endif
    </div>

    <div class="m-form__group form-group">
        <label for="">Aktif</label>
        <div>
        <span class="m-switch m-switch--icon">
            <label><input type="checkbox"
                          {{ ($item->aktif ?? false) == true ? 'checked' : ''}} name="aktif"><span></span>
            </label>
        </span>
        </div>
    </div>


</div>
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>
