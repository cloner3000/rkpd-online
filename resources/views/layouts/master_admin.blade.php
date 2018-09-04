<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.head')
        @stack('header.style')
    </head>
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <div id="rkpd">
        <div class="m-grid m-grid--hor m-grid--root m-page">
            @include('layouts.header_admin')
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
                    <i class="la la-close"></i>
                </button>
                <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
                    @include('layouts.left_bar_admin')
                </div>
                <div class="m-grid__item m-grid__item--fluid m-wrapper" style="min-height: 800px;">
                    @yield('content')
                </div>
            </div>
            @include('layouts.footer_admin')
        </div>
        <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
            <i class="la la-arrow-up"></i>
        </div>
    </div>

        <script src="{{ asset('/metronic/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/metronic/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/metronic/assets/demo/default/custom/components/forms/widgets/select2.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/axios.min.js') }}" type="text/javascript"></script>
        <script>
            let token = document.head.querySelector('meta[name="csrf-token"]');

            if (token) {
                window.csrfToken = token.content;
            } else {
                console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
            }
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        @stack('footer.javascript')
    </body>
</html>
