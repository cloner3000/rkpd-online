@extends('layouts.master_login')

@section('content')
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--singin" id="m_login">
            <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                <div class="m-stack m-stack--hor m-stack--desktop">
                    <div class="m-stack__item m-stack__item--fluid">
                        <div class="m-login__wrapper">
                            <div class="m-login__logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('/metronic/assets/app/media/img//logos/logo-login.png') }}">
                                </a>
                            </div>
                            <div class="m-login__signin">
                                <div class="m-login__head">
                                    <h3 class="m-login__title">
                                        Halaman Login
                                    </h3>
                                </div>
                                <form class="m-login__form m-form" method="POST" action="{{ route('login') }}">
                                    @if (session('status'))
                                        <div class="m-alert m-alert--outline m-alert--outline-2x alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            </button>
                                            <strong>Berhasil !</strong> {{ session('status') }}
                                        </div>
                                    @endif
                                    @include('auth.form._form_login')
                                </form>
                            </div>
                            <div class="m-login__forget-password">
                                <div class="m-login__head">
                                    <h3 class="m-login__title">
                                        Lupa Kata Sandi ?
                                    </h3>
                                    <div class="m-login__desc">
                                        Silahkan masukan alamat email Anda :
                                    </div>
                                </div>
                                <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}" id="form_forget_password">
                                    @include('auth.form._form_email')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url({{ asset('/metronic/assets/app/media/img//bg/bg-4.jpg') }})">
                <div class="m-grid__item m-grid__item--middle">
                    <h3 class="m-login__title text-white">
                        RKPD Online Kabupaten Sukabumi
                    </h3>
                    <p class="m-login__msg">
                       Sebuah Sistem Perencanaan yang Dikembangkan untuk Meningkatkan Integritas dan Profesionalisme. Sehingga Terjadinya Sinergitas Perencanaan Pembangunan di Kabupaten Sukabumi.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection