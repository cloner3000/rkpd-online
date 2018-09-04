@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Pengguna</h3>
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
                        <a href="{{ route('user.index') }}" class="m-nav__link">
                            <span class="m-nav__link-text">PENGATURAN</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <span class="m-nav__link-text">Hak Akses</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link {{ !empty(session('alert')['profile']) ? 'active' : '' }}
                                    {{ session('alert') || $errors->has('new') || $errors->has('new_confirmation') ? '' : 'active' }}"
                                       data-toggle="tab" href="#form_profile" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Ubah Pengguna
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link {{ !empty(session('alert')['password']) ? 'active' : '' }}
                                    {{ $errors->has('old') || $errors->has('new') || $errors->has('new_confirmation') ? 'active' : '' }}"
                                       data-toggle="tab" href="#form_password" role="tab">
                                        Ubah Password Pengguna
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane {{ !empty(session('alert')['profile']) ? 'active' : '' }}
                        {{ session('alert') || $errors->has('new') || $errors->has('new_confirmation') ? '' : 'active' }}"
                             id="form_profile">
                            <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('user.update', [$item->id]) }}">
                                {{ method_field('PUT') }}
                                @include('admin.user._form')
                            </form>
                        </div>
                        <div class="tab-pane {{ !empty(session('alert')['password']) ? 'active' : '' }}
                        {{ $errors->has('old') || $errors->has('new') || $errors->has('new_confirmation') ? 'active' : '' }}"
                             id="form_password">
                            <form class="m-form m-form--fit m-form--label-align-right" action="{{ route('user.update.password', [$item->id]) }}"
                                  method="post" enctype="multipart/form-data">
                                @include('admin.user._form_password')
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection