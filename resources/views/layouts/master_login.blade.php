<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('layouts.head')
    </head>
    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        @yield('content')
        <script src="{{ asset('/metronic/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/metronic/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/metronic/assets/snippets/pages/user/login.js') }}" type="text/javascript"></script>
    </body>
</html>
