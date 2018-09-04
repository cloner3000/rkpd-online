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
                            <div class="login__signin">
                                <div class="m-login__head">
                                    <h3 class="m-login__title">Perbaiki Kata Sandi</h3>
                                </div>
                                <form class="m-login__form m-form" method="POST" action="{{ route('password.request') }}">
                                    @include('auth.form._form_reset')
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