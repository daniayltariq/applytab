<!DOCTYPE html>
<html>
<!-- begin::Head -->
<?php $lang = session()->get('locale') == 'ar'; ?>

<head>
    <!--begin::Base Path (base relative path for assets of this page) -->
    @include('frontend.partials.header')
    @yield('styles')
    <style>
        @font-face {
            font-family: ExpoArabicBold;
            src: url({{asset('frontend/assets/fonts/Ar/Expo_Arabic_Bold.ttf')}});
        }
        @font-face {
            font-family: ExpoArabicBook;
            src: url({{asset('frontend/assets/fonts/Ar/Expo_Arabic_Book.ttf')}});
        }
        @font-face {
            font-family: ExpoArabicLight;
            src: url({{asset('frontend/assets/fonts/Ar/Expo_Arabic_Light.ttf')}});
        }
        @font-face {
            font-family: ExpoArabicMedium;
            src: url({{asset('frontend/assets/fonts/Ar/Expo_Arabic_Medium.ttf')}});
        }

        .dropdown-menu {
            background: #f7931d;
            -webkit-transition: all .25s ease;
            transition: all .25s ease;
            background: -webkit-gradient(linear, left bottom, left top, from(#f7931d), color-stop(50%, #fbbf19), to(#f7931d));
            background: linear-gradient(0deg, #f7931d 0%, #fbbf19 50%, #f7931d 100%);
            background-color: rgba(0, 0, 0, 0);
            background-position-x: 0%;
            background-position-y: 0%;
            background-size: auto;
            border: none;
            background-size: 200% 200%;
            background-position: bottom;
            filter: drop-shadow(0px 10px 10px rgba(245, 134, 69, 0.4));
            -webkit-filter: drop-shadow(0px 10px 10px rgba(245, 134, 69, 0.4));
            -moz-filter: drop-shadow(0px 10px 10px rgba(245, 134, 69, 0.4));
            cursor: pointer;

            @if ($lang)
                margin-left: -4rem;
            @endif
        }

        .dropdown-item {

            @if ($lang)
                font-size: 1.4rem;
            @else 
                font-size: 1.2rem;
            @endif 
            color: #282c2e;
            font-weight: 500 !important;
            color: #10075E;
        }

        .dropdown-item:hover {
            background-position: top;
            color: white;
            background: #f7931d;
            -webkit-transition: all .25s ease;
            transition: all .25s ease;
            background: -webkit-gradient(linear, left bottom, left top, from(#f7931d), color-stop(50%, #fbbf19), to(#f7931d));
            background: linear-gradient(0deg, #f7931d 0%, #fbbf19 50%, #f7931d 100%);
            background-color: rgba(0, 0, 0, 0);
            background-position-x: 0%;
            background-position-y: 0%;
            background-size: auto;
            border: none;
            background-size: 200% 200%;
            background-position: bottom;
            filter: drop-shadow(0px 10px 10px rgba(245, 134, 69, 0.4));
            -webkit-filter: drop-shadow(0px 10px 10px rgba(245, 134, 69, 0.4));
            -moz-filter: drop-shadow(0px 10px 10px rgba(245, 134, 69, 0.4));
        }

        .questions .card .card-header h5::before {
            @if ($lang)
                right: -1.2rem;
            @else 
                left: -1.2rem;
            @endif
        }

        .questions .card .card-body::before {
            @if ($lang)
                right: 5rem;
            @else 
                left: 5rem;
            @endif
        }


        .download-buttons a .button-content {
            @if ($lang)
                margin-inline-start: 1.3rem;
            @endif
        }

        .related-blog .section-heading {
            @if ($lang)
                width: 36%;
            @endif
        }

        .growth__box .content h3 {
            @if ($lang)
                width: 100%;
            @endif
        }

        .growth .row>div:nth-child(even) .growth__box .content::after {
            @if ($lang)
                right: 38.5rem;
                transform: translateY(-50%) rotate(-90deg);
                -webkit-transform: translateY(-50%) rotate(-90deg);
            @endif
        }

        .growth .row>div:nth-child(odd) .growth__box .content::before {
            @if ($lang)
                right: -3.3rem;
                transform: translateY(-50%) rotate(90deg);
                -webkit-transform: translateY(-50%) rotate(90deg);
            @endif
        }

    </style>
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body
    style=" @if ($lang) direction: rtl; text-align: right; font-family: ExpoArabicBook; @endif">
    @include('frontend.partials.loader')
    <!-- begin:: Page -->
    @include('frontend.partials.navbar')
    <!-- end:: Subheader -->

    @yield('content')
    <!-- begin:: Footer -->
    @include('frontend.partials.footer_content')

    @include('frontend.partials.footer')


    <!--end::Page Scripts -->
    @yield('scripts')

</body>
<!-- end::Body -->

</html>
