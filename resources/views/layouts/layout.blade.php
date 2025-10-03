<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Bebbus | METSIS{{ env('APP_NAME') }}</title>
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="SemiColonWeb">
    <meta name="description"
        content="Get Canvas to build powerful websites easily with the Highly Customizable &amp; Best Selling Bootstrap Template, today.">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo0.ico') }}">
    <!-- Font Imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital@0;1&display=swap"
        rel="stylesheet">

    <!-- Core Style -->
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">

    <!-- Font Icons -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-icons.css') }}">

    <!-- Plugins/Components CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/swiper.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Document Title
 ============================================= -->

    <style>
        @media (min-width: 992px) {
            .top-links-item {
                border-left: 0;
            }

            .header-misc-icon>a {
                width: 1.5rem;
                height: 1.5rem;
                font-size: 1.5rem;
                line-height: 1.5rem;
            }
        }

        .header-row .fbox-sm .fbox-icon {
            width: 1.25rem;
            height: 1.25rem;
        }

        .header-row .fbox-sm .fbox-icon i {
            position: relative;
            top: 1px;
            font-size: 1.25rem;
        }

        .header-shop-search input::-moz-placeholder {
            font-style: italic;
            opacity: .7;
        }

        .header-shop-search input::-webkit-input-placeholder {
            font-style: italic;
            opacity: .7;
        }
    </style>

</head>

<body class="stretched">

    <!-- Document Wrapper
 ============================================= -->
    <div id="wrapper">
        <!-- Top Bar - Header
  ============================================= -->
        @include('layouts.users.partials.header')
        <!-- Content
  ============================================= -->
        @yield('contenido')

        <!-- Footer
  ============================================= -->
        @include('layouts.users.partials.footer')

    </div><!-- #wrapper end -->

    <!-- Go To Top
 ============================================= -->
    <div id="gotoTop" class="uil uil-angle-up"></div>

    <!-- JavaScripts
 ============================================= -->
    <script src="{{ asset('frontend/js/plugins.min.js') }}"></script>
    <script src="{{ asset('frontend/js/functions.bundle.js') }}"></script>


</body>

</html>
