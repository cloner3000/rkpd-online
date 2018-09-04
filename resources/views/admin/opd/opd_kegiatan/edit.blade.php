@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Data OPD</h3>
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
                        <span class="m-nav__link-text">Data Umum Pemda</span>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <span class="m-nav__link-text">Data OPD</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                <h3 class="m-portlet__head-text">Ubah OPD : {{ $opd->nama }}</h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->

                    <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('opd.opd-kegiatan.update', [$item->id, $id]) }}">
                        <div class="col-md-12">
                            @if (session('alert'))
                                @include('global.notif_action', [
                                    'type'    => session('alert')['type'],
                                    'alert'   => session('alert')['alert'],
                                    'message' => session('alert')['message']
                                ])
                            @endif
                        </div>
                        {{ method_field('PUT') }}
                        @include('admin.opd.opd_kegiatan._form')
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
@endsection