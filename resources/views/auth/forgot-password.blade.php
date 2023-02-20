<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}} - Forgot Password </title>

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="{{asset('backend/assets/images/logo/favicon.png')}}"> --}}

    <!-- page css -->

    <!-- Core css -->
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet">
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
                                        <h1 class="m-b-0 w-100"><span class="text-color1">ApplyTab</span></h1>
                                        {{-- <h2 class="m-b-0 text-color2">Sign In</h2> --}}
                                    </div>
                                    
                                    <div class="mb-4 text-sm text-gray-600 font-13">
                                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                    </div>
                            
                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                            
                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                            
                                        <!-- Email Address -->
                                        <div>
                                            <x-label class="font-16" for="email" :value="__('Email')" />
                            
                                            <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus />
                                        </div>
                            
                                        <div class="flex items-center justify-end mt-4">
                                            <x-button class="btn-primary">
                                                {{ __('Email Password Reset Link') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="">© 2023 {{config('app.name')}}</span>
                    {{-- <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Privacy</a>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{asset('backend/assets/js/vendors.min.js')}}"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{asset('backend/assets/js/app.min.js')}}"></script>

</body>

</html>