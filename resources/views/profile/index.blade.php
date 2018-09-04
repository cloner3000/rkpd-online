@extends('layouts.master_admin')
@section('content')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    Akun Saya
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link {{ !empty(session('alert')['profile']) ? 'active' : '' }}
                                    {{ session('alert') || $errors->has('old') || $errors->has('new') || $errors->has('new_confirmation') ? '' : 'active' }}"
                                       data-toggle="tab" href="#form_profile" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Profile Pengguna
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link {{ !empty(session('alert')['password']) ? 'active' : '' }}
                                    {{ $errors->has('old') || $errors->has('new') || $errors->has('new_confirmation') ? 'active' : '' }}"
                                       data-toggle="tab" href="#form_password" role="tab">
                                        Ubah Kata Kunci
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane {{ !empty(session('alert')['profile']) ? 'active' : '' }}
                        {{ session('alert') || $errors->has('old') || $errors->has('new') || $errors->has('new_confirmation') ? '' : 'active' }}"
                             id="form_profile">
                            <form class="m-form m-form--fit m-form--label-align-right" action="{{ route('profile.user.update') }}"
                                  method="post" enctype="multipart/form-data">
                                @include('profile._form_edit_profile')
                            </form>
                        </div>
                        <div class="tab-pane {{ !empty(session('alert')['password']) ? 'active' : '' }}
                        {{ $errors->has('old') || $errors->has('new') || $errors->has('new_confirmation') ? 'active' : '' }}"
                             id="form_password">
                            <form class="m-form m-form--fit m-form--label-align-right" action="{{ route('profile.update.kata_sandi') }}"
                                  method="post" enctype="multipart/form-data">
                                @include('profile._form_edit_password')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection