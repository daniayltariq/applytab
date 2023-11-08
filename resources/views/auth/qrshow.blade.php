<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}} - Google AUthenticator </title>

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="{{asset('backend/assets/images/logo/favicon.png')}}"> --}}

    <!-- page css -->

    <!-- Core css -->
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <style>
        .text-color1{
            color: #5661b3;
        }

        .text-color2{
            color: #66554b;
        }

        body{
            font-size: 1rem !important;
        }

        .form-control {
            padding: 1rem 2.2rem !important;
        }

        .card {
            border: none !important;
        }

        .btn-indigo{
            background-color: rgba(86, 97, 179);
        }

        .bg-indigo{
            background-color: rgba(47, 54, 95);
        }
    </style>
</head>

<body>
    <div class="app bg-indigo">
        <div class="container-fluid p-h-0 p-v-20 full-height d-flex">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            <div class="card {{-- shadow-lg --}}">
                                <div class="card-body">
                                    <div class="d-flex text-center justify-content-between m-b-30">
                                        <h1 class="m-b-0 w-100"><span class="text-color1">Google Authenticator</span></h1>
                                    </div>

                                    <div class="login" id="qrdiv" style="text-align:center; padding-bottom:1rem;">
                                        <h1>Google Authenticator Pairing</h1>
                                        <div class="alert alert-danger text-center" role="alert">
                                            <?php echo($message);?>
                                        </div>
                                        @php echo($apiResponse); @endphp
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <button class="btn btn-indigo text-white mt-3">Sign In</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2023 {{config('app.name')}}</span>
                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{asset('backend/assets/js/vendors.min.js')}}"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{asset('backend/assets/js/app.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            @if(session()->has('error'))
                toastr.error('{{ session('error') }}')
            @endif

            @if(session()->has('warning'))
                toastr.warning('{{ session('warning') }}')
            @endif


            @if(session()->has('status'))
                toastr.success('{{ session('status') }}')
            @endif
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var qrtitle = document.getElementById('qrdiv').getElementsByTagName('a')[0].getAttribute("title");
            var qronly = qrtitle.replace("Manually pair with", "").trim();
            var html = "<div class='qrinternaldiv'><span>"+qrtitle+"</span></div>";
            document.getElementById('qrdiv').innerHTML += html;
            // console.log(qrtitle);
        });
    </script>
</body>

</html>
