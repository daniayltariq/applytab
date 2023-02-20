@extends('frontend.layouts.app')

@section('content')
<?php $lang = session()->get('locale') == 'ar'; ?>
    <!--hero section start-->
    <section class="hero blog_hero">
        <div class="hero__wrapper blog_hero__wrapper">
            <div class="container">
                <h4 class="section-heading">{!! __('Terms and Condition') !!}</h4>
                {{-- <div class="row">
                    <div>
                        <h1>Terms and Condition</h1>
                    </div>
                    <div>
                        <ul>
                            <li><a href="{{route('/')}}">Home</a></li>
                            <li><a href="{{route('page','blog')}}"><i class="fad fa-long-arrow-right"></i>Blog</a></li>
                        </ul>
                        <div class="icon">
                            <i class="fad fa-bullhorn"></i>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!--hero section end-->

    <!--blog start-->
    <section class="provider" id="Provider">
        <div class="provider__wrapper">
            <div class="container">
                {{-- <h2 class="section-heading">{!! __('provider_section_heading_1') !!}</h2> --}}
                <p class="paragraph dark">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>

            </div>
        </div>
    </section>
    <!--blog end-->
@endsection