<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{ url('assets/admin/css/pages/login/login-2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="{{ url('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ url('assets/admin/css/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    <link rel="shortcut icon" href="{{ url('assets/admin/media/logos/favicon1.ico') }}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="{{ url('admin/dashboard') }}">
                <img alt="Logo" src="{{ url('assets/admin/media/logos/logo-light.png') }}" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left"
                id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                    class="flaticon-more"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->

    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            @include('layouts.admin_leftbar')
            <!-- Content area started -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                <!-- Begin:: Header -->
                @include('layouts.admin_header')
                {!! Form::open([
                    'route' => 'change-group-id',
                    'method' => 'POST',
                    'id' => 'ChangeGroupId',
                ]) !!}
                {!! Form::hidden('group_id', Auth::user()->group_id, ['class' => 'form-group-id']) !!}
                {!! Form::close() !!}

                <!-- end:: Header -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                    @yield('content')
                </div>

                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            {{ date('Y') }}&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic"
                                target="_blank" class="kt-link">{{ config('app.name') }}</a>
                        </div>
                    </div>
                </div>
                <!-- end:: Footer -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this record?</p>
                                <form method="POST" action="#" id="delete_data" name="delete_data"
                                    class="kt-form kt-form--label-right" enctype="multipart/form-data">
                                    <input type="hidden" id="record_id" name="record_id">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary submit_delete">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content area started -->
        </div>
    </div>
    <!-- end:: Page -->
    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>

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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ url('assets/admin/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/plugins/custom/prismjs/prismjs.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/js/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ url('assets/admin/js/pages/widgets.js') }}"></script>
    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ url('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/admin/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('assets/admin/js/pages/crud/datatables/extensions/buttons.js') }}"></script>
    <script src="{{ url('assets/admin/js/pages/crud/datatables/extensions/buttons.min.js') }}"></script>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
    <script src="{{ url('assets/admin/plugins/custom/gmaps/gmaps.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!--end::Page Vendors -->
    @yield('script')
</body>

<!-- end::Body -->

</html>
