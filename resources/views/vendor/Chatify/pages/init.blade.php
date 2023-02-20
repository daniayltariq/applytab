<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sanad - Chat </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/logo/favicon.png')}}">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet">
    <style>
        .fullpage-loader{
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: none;
            z-index: 9999;
            background: #000000eb;
        }

        .fullpage-loader .loader-wrapper{
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            z-index: 9999;
            text-align: center;
        }
    </style>
</head>

<body>
    @include('components.loader')
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('{{asset('backend/assets/images/others/login-3.png')}}')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto">
                            
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2021 Sanad.sa</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{asset('backend/assets/js/vendors.min.js')}}"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{asset('backend/assets/js/app.min.js')}}"></script>
    <script>
        
        function fullPageLoader(val){
            if(val == true){
                $('#fullpage-loader').show();
            }else{
                $('#fullpage-loader').hide();
            }
        }

        $(document).ready(function(){
            // ajax csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // check if url has token query string
            if(window.location.href.indexOf('token=') > -1){

                fullPageLoader(true);
                // get token from url
                var token = window.location.href.split('token=')[1];
                // make ajax call with token
                $.ajax({
                    url: '{{ route("chatify.validate_token") }}',
                    type: 'GET',
                    data: {
                        token: token
                    },
                    success: function(data){
                        // if success
                        if(data.success ){
                            var chatify_url='{{url('/')}}/chatify';
                            window.location.href = chatify_url+'/1'/* +data.user.id */;
                            fullPageLoader(false);
                        }else{
                            fullPageLoader(false);
                            alert('Invalid token');
                        }
                    }
                });
            }else{
                fullPageLoader(false);
            }
        })
    </script>
</body>

</html>