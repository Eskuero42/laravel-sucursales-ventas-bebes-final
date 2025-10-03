<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/forms-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:47:37 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Bebbus | METSIS{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo0.ico') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- multi.js css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/libs/multi.js/multi.min.css') }}" />
    <!-- autocomplete css -->
    <link rel="stylesheet"
        href="{{ asset('backend/assets/libs/%40tarekraafat/autocomplete.js/css/autoComplete.css') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('backend/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('backend/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .texto-blanco {
            color: white;
        }
    </style>
</head>

<body>

    @include('layouts.admin.header')

    <!-- ========== App Menu ========== -->
    @include('layouts.admin.navbar')
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                @yield('contenido')

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('layouts.admin.footer')
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @stack('script')
    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins.js') }}"></script>

    <!-- multi.js -->
    <script src="{{ asset('backend/assets/libs/multi.js/multi.min.js') }}"></script>
    <!-- autocomplete js -->
    <script src="{{ asset('backend/assets/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('backend/assets/js/pages/form-advanced.init.js') }}"></script>
    <!-- input spin init -->
    <script src="{{ asset('backend/assets/js/pages/form-input-spin.init.js') }}"></script>
    <!-- input flag init -->
    <script src="{{ asset('backend/assets/js/pages/flag-input.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/forms-advanced.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:47:39 GMT -->

</html>
