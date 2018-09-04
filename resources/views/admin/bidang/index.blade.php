<!-- blade ini hasil pengembangan lanjutan oleh developer pihak kedua -->

@php($canEntry = true)
@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Hak Akses</h3>
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
                        <a href="{{ route('role.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">Pengaturan - Pengguna Hak Akses Bidang</span>
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
                        <h3 class="m-portlet__head-text">Pengaturan Hak Akses Bidang</h3>
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
                <form class="m-form" method="POST" action="{{ route('bidang') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="checked_opd" id="checked_opd" value="0">

                    <!--begin: Datatable -->
                    <table class="table table-hover" id="" width="100%">
                        <thead>
                        <tr>
                            <th rowspan="2" align="top">No.</th>
                            <th rowspan="2" align="top">
                                <h5 align="top">Perangkat</h5>
                            </th>
                            <th colspan="3">
                                <h5 align="center">Hak Akses Bidang</h5>
                            </th>
                        </tr>
                        <tr>   
                            <th><h5>PMM</h5></th>
                            <th><h5>IPW</h5></th>
                            <th><h5>ESDA</h5></th>
                        </tr>
                        </thead>
                        <tbody>

                        @for ($i = 1; $i < $length+1; $i++)
                            <tr>
                                <td>
                                    {{ $count++ }}
                                </td>
                                <td>
                                    {{ $opds[$i-1]->nama }}
                                </td>
                                <td>
                                    <input type="radio" name="opd[{{ $i }}]" value="1" id="{{ $opds[$i-1]->id }}" class="iradio_square-grey" @if ($all_bidang_permission[$i-1]->bidang_id == 1)
                                        checked 
                                    @endif/>
                                </td>
                                <td>
                                    <input type="radio" name="opd[{{ $i }}]" value="2" id="{{ $opds[$i-1]->id }}" class="iradio_square-grey" @if ($all_bidang_permission[$i-1]->bidang_id == 2)
                                        checked @endif/>
                                </td>
                                <td>
                                    <input type="radio" name="opd[{{ $i }}]" value="3" id="{{ $opds[$i-1]->id }}" class="iradio_square-grey" @if ($all_bidang_permission[$i-1]->bidang_id == 3)
                                        checked @endif/>
                                </td>
                            </tr>
                        @endfor

                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                        <a href="{{ route('bidang') }}"><button type="button" class="btn btn-default">Batal</button></a>
                    </div>
                    <!--end: Datatable -->
                </form>
            </div>
        </div>
    </div>

@endsection

@push('footer.javascript')
    <script>

        
    </script>
@endpush