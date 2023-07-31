<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Taxi App') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{ url('assets/admin/css/pages/login/login-2.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('assets/admin/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">

    <link rel="shortcut icon" href="{{ url('assets/admin/media/logos/favicon1.ico') }}" />


</head>


<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                style="background-image: url({{ url('assets/admin/media/bg/bg-1.jpg') }});">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Page -->

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": [
                        "#c5cbe3",
                        "#a1a8c3",
                        "#3d4465",
                        "#3e4466"
                    ],
                    "shape": [
                        "#f0f3ff",
                        "#d9dffa",
                        "#afb4d4",
                        "#646c9a"
                    ]
                }
            }
        };
    </script>

    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script type="text/javascript">
        window.baseUrl = "<?php echo URL::to('/'); ?>";
    </script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script src="{{ url('assets/admin/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/js/scripts.bundle.js') }}" type="text/javascript"></script>


    <!--end::Global Theme Bundle -->


    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ url('assets/admin/js/pages/custom/login/login-general.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->


    @yield('script')

</body>

</html>
