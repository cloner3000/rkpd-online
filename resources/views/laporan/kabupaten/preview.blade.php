@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Musrenbang Kabupaten</h3>
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
                            <span class="m-nav__link-text">MUSRENBANG</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ route('awal.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">Musrenbang Kabupaten</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Laporan Musrenbang Kabupaten</h3>
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

                <div class="pull-right">
                    <form action="{{ route('export.excel.kabupaten') }}" style="display:inline;" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="district" value="{{ $district->id ?? null }}">
                        <input type="hidden" name="village" value="{{ $village->id ?? null }}">
                        <input type="hidden" name="user" value="{{ $user->id ?? null }}">
                        <button type="submit" class="btn m-btn--pill m-btn--air btn-secondary">
                            Excel
                        </button>
                    </form>
                    <a href="{{ route('laporan.awal') }}" class="btn m-btn--pill m-btn--air btn-secondary">Kembali</a>
                </div>
                <br><br><br>

                <hr>

                <iframe frameborder="0" width="100%" height="500" name="form_laporan"
                        src="{{ route('laporan.kabupaten.preview', ['district' => $district, 'village' => $village, 'user' => $user]) }}"></iframe>

            </div>
        </div>
    </div>
@endsection
