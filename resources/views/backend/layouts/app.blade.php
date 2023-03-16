@inject('request', 'Illuminate\Http\Request')
<!DOCTYPE html>
<html lang="en" >
    
    <head>
        @include('backend.partials.header')
        
        @yield('styles')
        
        <style>
            
            * {
                font-family: "Arial";
            }

            .error{
                    color: red;
                }  

            body{
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            }

            .is-folded .side-nav .side-nav-inner .side-nav-menu>li>a.dropdown-toggle{
                padding-left: 15px !important;
            }

            .text-color1{
                color: white;
            }

            .text-color2{
                color: #66554b;
            }

            @media only screen and (min-width: 992px)
            {
                .is-folded .header .logo h1.logo-unfold {
                    display: none;
                }
            }

            .anticon{
                line-height: unset !important;
            }

            .ft-size-17{
                font-size: 17px !important;
                line-height: 1.2 !important;
            }

            .logo{
                background-color: #485080 !important;
            }
            .stats-icon{
                font-size: 27px;
                color: rgba(47, 54, 95);
            }

            .stats-val{
                color: rgba(47, 54, 95);
            }

            .sidebar-bg{
                background-color: #485080 !important;
            }

            .side-nav .side-nav-inner .side-nav-menu li{
                margin-bottom: 10px;
            }
            .side-nav .side-nav-inner .side-nav-menu li:hover,.dropdown.open{
                background-color: #f9fbfd;
                border-radius: 16px 0 0 16px;
                margin-left: 0.5rem !important;
                /* margin-right: 0.5rem !important; */
            }

            .side-nav .side-nav-inner .side-nav-menu li.active{
                background-color: #f9fbfd;
                border-radius: 16px 0 0 16px;
                margin-left: 0.5rem !important;
                /* margin-right: 0.5rem !important; */
            }

            .side-nav .side-nav-inner .side-nav-menu li:after{
                border-right: unset;
                border-color: unset;
            }

            .side-nav .side-nav-inner .side-nav-menu,.header .logo{
                border-right: none !important;
            }

            .ps-container.ps-in-scrolling.ps-y>.ps-scrollbar-y-rail{
                background-color: none !important;
            }

            .ps-container.ps-in-scrolling.ps-y>.ps-scrollbar-y-rail>.ps-scrollbar-y{
                background-color: #dedede;
                width: 5px;
            }

        </style>
    </head>
    <!-- end::Head -->
    <!-- begin::Body -->
    <body>
        <div class="app">
            <div class="layout">
                <!-- begin:: BODY -->
                @include('backend.partials.extra')
                @include('backend.partials.navbar')

                @include('backend.partials.sidebar')

                <div class="page-container">
                    
                    @yield('content')

                    <!-- begin:: Footer -->
                    @include('backend.partials.footbar')
                    <!-- end:: Footer -->           
                </div>
            </div>
        </div>
        @include('backend.components.confirm-dialog')

        @include('backend.partials.footer')
        @yield('scripts')
    </body>
</html>