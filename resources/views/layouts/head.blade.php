<meta charset="utf-8" />
<title>
    {{ config('app.name', 'Metronic | Dashboard') }}
</title>
<meta name="description" content="Latest updates and statistic charts">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="{{ asset('js/webfont.js') }}"></script>
<script>
    WebFont.load({
        google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<link href="{{ asset('/metronic/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/metronic/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/metronic/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="{{ asset('/metronic/assets/app/media/img//logos/favicon.ico') }}" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
