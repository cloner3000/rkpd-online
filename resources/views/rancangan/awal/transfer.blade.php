@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Rancangan Awal</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ route('home') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ route('musrenbang-desa.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">MUSRENBANG</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="#" class="m-nav__link">
                            <span class="m-nav__link-text">Rancangan Awal</span>
                        </a>
                    </li>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Transfer Rancangan Awal</h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                @if (session('alert'))
                    @include('global.notif_action', [
                        'type'    => session('alert')['type'],
                        'alert'   => session('alert')['alert'],
                        'message' => session('alert')['message']
                    ])
                @endif

                <form class="m-form m-form--fit m-form--label-align-right"
                      action="{{ route('awal.transfer.store', ['id' => $item->id]) }}" method="POST">
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
                                    <input type="hidden" name="tahun"
                                           value="{{ $item->tahun ?? (Carbon\Carbon::now()->year + 1)  }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group {{ $errors->has('sumber_anggaran') ? 'has-danger' : '' }}">
                                    @if(if_route_pattern(['musrenbang-desa.*', 'musrenbang-kelurahan.*']))
                                        <label>Sumber Anggaran</label>
                                        <select class="form-control m-select2" id="m_select2_1" name="sumber_anggaran"
                                                required disabled>
                                            <option value="{{ $item->sumberAnggaran->id }}">{{ $item->sumberAnggaran->nama }}</option>
                                        </select>
                                        <input type="hidden" name="sumber_anggaran"
                                               value="{{ $sumberAnggaranPuguIndikatif->id }}">
                                    @else
                                        <label>
                                            Sumber Anggaran
                                        </label>
                                        <select class="form-control m-select2" id="m_select2_1" name="sumber_anggaran"
                                                disabled>
                                            <option disabled selected>-- Silahkan Pilih --</option>
                                            @forelse($sumberAnggarans as $anggaran)
                                                <option {{ $item->sumberAnggaran->id == $anggaran->id ? 'selected' : '' }} value="{{ $anggaran->id }}">
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
                            <input type="text" class="form-control m-form" value="{{ $item->kegiatan->nama }}" disabled
                                   readonly>
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
                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="2" disabled
                                  readonly>{{ $item->kegiatan->deskripsi ?? '' }}</textarea>
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
                                                       value="{{ $target->indikatorKegiatan->tolak_ukur }}" readonly
                                                       disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group m-form__group">
                                                <label>Target</label>
                                                <input type="number" min="0" step="any"
                                                       name="target_indikator_kegiatan[{{ $target->indikatorKegiatan->id }}]"
                                                       class="form-control m-input"
                                                       value="{{ $target->target }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group m-form__group">
                                                <label>Satuan</label>
                                                <input type="text"
                                                       value="{{ $target->indikatorKegiatan->satuan->nama }}"
                                                       class="form-control m-input" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div class="form-group m-form__group clearfix">
                                                <label class="clearfix">
                                                </label>
                                            </div>
                                        </div>
                                    </div></br>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <hr>
                    <h5>Indikator Hasil Kegiatan</h5>

                    <div class="form-group" id="indikator_container">
                        @if(isset($item))
                            @foreach ($item->targetAnggaran as $target)
                                @if ($target->indikatorKegiatan->indikatorHasil->id == 3)
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group m-form__group">
                                                <label>Tolak Ukur</label>
                                                <input type="text" class="form-control m-input"
                                                       value="{{ $target->indikatorKegiatan->tolak_ukur }}" readonly
                                                       disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group m-form__group">
                                                <label>Target</label>
                                                <input type="number" min="0" step="any"
                                                       name="target_indikator_hasil[{{ $target->indikatorKegiatan->id }}]"
                                                       class="form-control m-input"
                                                       value="{{ $target->target }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group m-form__group">
                                                <label>Satuan</label>
                                                <input type="text"
                                                       value="{{ $target->indikatorKegiatan->satuan->nama }}"
                                                       class="form-control m-input" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div class="form-group m-form__group clearfix">
                                                <label class="clearfix">
                                                </label>
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

                    <div class="form-group m-form__group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="2" disabled
                                  readonly>{{ $item->lokasi ?? '' }}</textarea>
                    </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">Transfer</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
