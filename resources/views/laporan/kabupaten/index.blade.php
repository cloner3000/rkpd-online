@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">{{ $title ?? 'Laporan' }}</h3>
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
                        <a href="{{ route('awal.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">{{ $title ?? 'Laporan' }} Musrenbang Kabupaten</span>
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
                        <h3 class="m-portlet__head-text">{{ $title ?? 'Laporan' }} Musrenbang Kabupaten</h3>
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

                <form action="{{ route('laporan.kabupaten.preview') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-2">
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
                    </div>

                    @role(\App\Enum\Roles::OPD)

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group m-form__group {{ $errors->has('tahun') ? 'has-danger' : ''}}">
                                <label>
                                    OPD
                                </label>
                                <select class="form-control m-select2" id="m_select2_1" disabled>
                                    @php($user = auth()->user())
                                    <option selected value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                </select>
                                <input type="hidden" name="user_id" value="{{ $user->id  }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <div class="form-group m-form__group">
                                <label>
                                    Kecamatan *
                                </label>
                                <select class="form-control m-select2" name="district_id" id="select_district_2">
                                    <option selected value="0">Pilih Semua</option>
                                    @foreach( $districts as $val => $name)
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group m-form__group">
                                <label>
                                    Desa / Kelurahan
                                </label>
                                <select class="form-control m-select2" id="select_village" name="village_id">
                                    <option value="0" selected>Pilih Semua</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @endrole

                    @role(\App\Enum\Roles::KECAMATAN)

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group m-form__group {{ $errors->has('tahun') ? 'has-danger' : ''}}">
                                <label>
                                    OPD
                                </label>
                                <select class="form-control m-select2" id="m_select2_1" disabled>
                                    @php($user = auth()->user())
                                    <option selected value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                </select>
                                <input type="hidden" name="user_id" value="{{ $user->id  }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <div class="form-group m-form__group">
                                <label>
                                    Kecamatan *
                                </label>
                                <select class="form-control m-select2" name="district_id" disabled>
                                    <option disabled selected>-- Silahkan Pilih --</option>
                                    <option selected
                                            value="{{ $district->id }}">{{ $district->name }}</option>
                                </select>
                                <input type="hidden" name="district_id" value="{{ $district->id }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group m-form__group">
                                <label>
                                    Desa / Kelurahan
                                </label>
                                <select class="form-control m-select2" id="village_laporan_desa" name="village_id">
                                    <option value="0" selected>Pilih Semua</option>
                                    @foreach ($villages as $val => $name)
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endrole

                    @role(\App\Enum\Roles::ADMIN)

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group m-form__group">
                                <label>
                                    OPD
                                </label>
                                <select class="form-control m-select2" id="user_id" name="user_id">
                                    <option selected value="0">Pilih Semua</option>
                                    @foreach ($users as $key => $val)
                                        <option value="{{ $key  }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <div class="form-group m-form__group">
                                <label>
                                    Kecamatan *
                                </label>
                                <select class="form-control m-select2" name="district_id" id="select_district_2">
                                    <option selected value="0">Pilih Semua</option>
                                    @foreach( $districts as $val => $name)
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group m-form__group">
                                <label>
                                    Desa / Kelurahan
                                </label>
                                <select class="form-control m-select2" id="select_village" name="village_id">
                                    <option value="0" selected>Pilih Semua</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @endrole

                    <div class="form-group">
                        <div class="col-12">
                            <label></label>
                            <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('footer.javascript')
    <script>
        $('#village_laporan_desa').select2();

        $('#user_id').select2();

        let district2 = $('#select_district_2');
        district2.select2();

        let village = $('#select_village').select2();
        village.select2();

        var url = "{{ route('location.villagegs', ':id')  }}";

        district2.on('change', function () {
            var newUrl = url.replace(':id', $(this).val());
            axios.get(newUrl, {type: 'Desa'})
                .then((res) => {

                    village
                        .empty()
                        .append('<option value="0" selected="selected">Pilih Semua</option>');

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
    </script>
@endpush
