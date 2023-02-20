@extends('frontend.layouts.app')

@section('content')
<?php $lang = session()->get('locale') == 'ar'; ?>
    <!--hero section start-->
    <section class="hero">
        <div class="hero__wrapper">
            <div class="container">
                <div class="row align-items-lg-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <h1 class="main-heading">@lang('slider_heading_1')</h1>
                        <p class="paragraph">{!! __('slider_sub_heading') !!}</p>
                        <div class="download-buttons">
                            <a href="#" class="google-play">
                                <i class="fab fa-google-play"></i>
                                <div class="button-content">
                                    <h6>@lang('GET IT ON') <span>Google Play</span></h6>
                                </div>
                            </a>
                            <a href="#" class="apple-store">
                                <i class="fab fa-apple"></i>
                                <div class="button-content">
                                    <h6>@lang('GET IT ON') <span>Apple Store</span></h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="questions-img hero-img">
                            <img src="{{ asset('frontend/assets/images/phone-01.png') }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hero section end-->

    <!--feature section start-->
    <section class="feature" id="intro">
        <div class="container">
            <h2 class="section-heading">@lang('feature_section_heading_1')</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="feature__box feature__box--1">
                        <div class="icon icon-1">
                            <img src="{{ asset('frontend/assets/images/step-1.svg') }}" width="90" alt="">
                        </div>
                        <div class="feature__box__wrapper">
                            <div class="feature__box--content feature__box--content-1">
                                <h3>@lang('feature_box_1')</h3>
                                <p class="paragraph dark">@lang('feature_box_1_paragraph')</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature__box feature__box--2">
                        <div class="icon icon-2">
                            <img src="{{ asset('frontend/assets/images/step-2.svg') }}" width="90" alt="">
                        </div>
                        <div class="feature__box__wrapper">
                            <div class="feature__box--content feature__box--content-2">
                                <h3>@lang('feature_box_2')</h3>
                                <p class="paragraph dark">@lang('feature_box_2_paragraph')</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature__box feature__box--3">
                        <div class="icon icon-3">
                            <img src="{{ asset('frontend/assets/images/step-3.svg') }}" width="90" alt="">
                        </div>
                        <div class="feature__box__wrapper">
                            <div class="feature__box--content feature__box--content-3">
                                <h3>@lang('feature_box_3')</h3>
                                <p class="paragraph dark">@lang('feature_box_3_paragraph')</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature__box feature__box--4">
                        <div class="icon icon-4">
                            <img src="{{ asset('frontend/assets/images/step-4.svg') }}" width="90" alt="">
                        </div>
                        <div class="feature__box__wrapper">
                            <div class="feature__box--content feature__box--content-4">
                                <h3>@lang('feature_box_4')</h3>
                                <p class="paragraph dark">@lang('feature_box_4_paragraph')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--feature section end-->

    <!--video section start-->
    <div class="video" id="video">
        <div class="video__wrapper">
            <div class="container">
                <div class="video__play">
                    <button type="button" data-toggle="modal" data-target="#videoModal">
                        <i class="fad fa-play"></i>
                    </button>
                    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-close">
                                    <button type="button" data-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="ytdefer yt-video" style="width: 100%; height: 100%;" data-src="2BrCE_zxM0U">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video__background">
                    <img src="{{ asset('frontend/assets/images/video-bg-1.png') }}" alt="image" class="texture-1">
                    <img src="{{ asset('frontend/assets/images/video-img.png') }}" alt="image" class="phone">
                    <img src="{{ asset('frontend/assets/images/video-bg-2.png') }}" alt="image" class="texture-2">
                </div>
            </div>
        </div>
    </div>
    <!--video section end-->

    <!--Provider section start-->
    <section class="provider" id="Provider">
        <div class="provider__wrapper">
            <div class="container">
                <h2 class="section-heading">{!! __('provider_section_heading_1') !!}</h2>

                @if($errors->any())
                    <div style="margin: 5rem 3rem;">
                            <ul style="list-style: disc;">
                                @foreach ($errors->all() as $error)
                                    <li style="color:red;font-size: 15px">{{ $error }}</li>
                                @endforeach
                            </ul>
                    </div>
                @endif

                <form action="{{route('join-us')}}" method="POST" class="provider__wrapper--field">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" placeholder="@lang('Company Name')" name="company_name" value="{{old('company_name')}}" class="input-field">
                            
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="@lang('Worker Name')" name="worker_name" value="{{old('worker_name')}}" class="input-field">
                            
                        </div>
                        <div class="col-md-6">
                            <select type="text" placeholder="@lang('City')" name="city" value="{{old('city')}}" class="input-field">
                                <option value="01">@lang('Select City')</option>
                                <option value="Riyadh">Riyadh</option>
                                <option value="Dammam">Dammam</option>
                                <option value="Jeddah">Jeddah</option>
                                <option value="Makkah">Makkah</option>
                            </select>
                            
                        </div>
                        <div class="col-md-6">
                            <input type="text" placeholder="@lang('Phone Number')" name="phone" value="{{old('phone')}}" class="input-field">
                            
                        </div>


                        <div class="col-lg-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                    @lang('form_section_check_label') <a href="#">@lang('form_section_check_link')</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <button class="button"><span>@lang('form_section_button')

                                <i class="
                                @if ($lang)
                                fad fa-long-arrow-left
                                @else
                                fad fa-long-arrow-right
                                @endif
                                "></i>
                            </span></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
    <!--growth section end-->
    <section class="growth" id="feature">
        <div class="growth__wrapper">
            <div class="container">
                <h2 class="section-heading">{!! __('growth_section_heading_1') !!}</h2>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-trophy-alt"></i>
                            </div>
                            <div class="content">
                                <h3>@lang('growth_box_1')</h3>
                                <p class="paragraph dark">@lang('growth_box_1_paragraph')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-barcode-read"></i>
                            </div>
                            <div class="content">
                                <h3>@lang('growth_box_2')</h3>
                                <p class="paragraph dark">@lang('growth_box_2_paragraph')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-poll-people"></i>
                            </div>
                            <div class="content">
                                <h3>@lang('growth_box_3')</h3>
                                <p class="paragraph dark">@lang('growth_box_3_paragraph')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-award"></i>
                            </div>
                            <div class="content">
                                <h3>@lang('growth_box_4')</h3>
                                <p class="paragraph dark">@lang('growth_box_4_paragraph')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-user-tag"></i>
                            </div>
                            <div class="content">
                                <h3>@lang('growth_box_5')</h3>
                                <p class="paragraph dark">@lang('growth_box_5_paragraph')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-user-headset"></i>
                            </div>
                            <div class="content">
                                <h3>@lang('growth_box_6')</h3>
                                <p class="paragraph dark">@lang('growth_box_6_paragraph')</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--growth section end-->

    <!--questions section start-->
    <section class="questions" id="faq">
        <div class="questions__wrapper">
            <div class="container">
                <h2 class="section-heading">@lang('questions_section_heading_1')</h2>
                <div class="row align-items-lg-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div id="accordion">
                            <div class="card" id="card-1">
                                <div class="card-header" id="heading-1">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-1"
                                            aria-expanded="true" aria-controls="collapse-1">
                                            @lang('question_accordion_1')
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">@lang('question_accordion_1_paragraph')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-2">
                                <div class="card-header" id="heading-2">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                            @lang('question_accordion_2')
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-2" class="collapse" aria-labelledby="heading-2"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">@lang('question_accordion_2_paragraph')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-3">
                                <div class="card-header" id="heading-3">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                            @lang('question_accordion_3')
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-3" class="collapse" aria-labelledby="heading-3"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">@lang('question_accordion_3_paragraph')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-4">
                                <div class="card-header" id="heading-4">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                            @lang('question_accordion_4')
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-4" class="collapse" aria-labelledby="heading-4"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">@lang('question_accordion_4_paragraph')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-5">
                                <div class="card-header" id="heading-5">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                            @lang('question_accordion_5')
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-5" class="collapse" aria-labelledby="heading-5"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">@lang('question_accordion_5_paragraph')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-6">
                                <div class="card-header" id="heading-6">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">
                                            @lang('question_accordion_6')
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-6" class="collapse" aria-labelledby="heading-6"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">@lang('question_accordion_6_paragraph')
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-7">
                                <div class="card-header" id="heading-7">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-7" aria-expanded="false" aria-controls="collapse-7">
                                            @lang('question_accordion_7')
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-7" class="collapse" aria-labelledby="heading-7"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">@lang('question_accordion_7_paragraph')
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="questions-img">
                            <img src="{{ asset('frontend/assets/images/phone-01.png') }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--questions section end-->

    <!--client section start-->
    <section class="clients-sec" id="feedback">
        <div class="container">
            <div class="clients">
                <div class="clients__info">
                    <h3>@lang('client_section_heading_1')</h3>
                    <p class="paragraph dark">@lang('client_section_heading_1_paragraph')</p>
                </div>
                <div class="swiper-container clients-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('frontend/assets/images/client-img-01.png') }}" alt="image"></a>
                        </div>
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('frontend/assets/images/client-img-02.png') }}" alt="image"></a>
                        </div>
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('frontend/assets/images/client-img-03.png') }}" alt="image"></a>
                        </div>
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('frontend/assets/images/client-img-04.png') }}" alt="image"></a>
                        </div>
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('frontend/assets/images/client-img-05.png') }}" alt="image"></a>
                        </div>
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('frontend/assets/images/client-img-06.png') }}" alt="image"></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--client section end-->


    <!--screenshot section start-->
    <section class="screenshot" id="preview">
        <div class="screenshot__wrapper">
            <div class="container">
                <div class="screenshot__info">
                    <h2 class="section-heading">@lang('screenshot_section_heading_1')</h2>
                    <div class="screenshot-nav">
                        <div class="screenshot-nav-prev">
                            <i 
                            class="
                                @if ($lang)
                                fad fa-long-arrow-right
                                @else
                                fad fa-long-arrow-left
                                @endif"
                                ></i>
                        </div>
                        <div class="screenshot-nav-next" @if ($lang) style="margin-inline-start: 4rem;" @endif>
                            <i class=" @if ($lang)
                                fad fa-long-arrow-left
                                @else
                                fad fa-long-arrow-right
                                @endif"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-container screenshot-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('frontend/assets/images/screen-01.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('frontend/assets/images/screen-02.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('frontend/assets/images/screen-03.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('frontend/assets/images/screen-04.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('frontend/assets/images/screen-05.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('frontend/assets/images/screen-06.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('frontend/assets/images/screen-07.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('frontend/assets/images/screen-08.png') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--screenshot section end-->

    <!--related blog section start-->
    <section class="related-blog blog" id="blog">
        @include('frontend.components.blog')
    </section>
    <!--related blog section end-->

    <!--contact-us section start-->
    <section class="contact-us" id="contact">
        @include('frontend.components.contact-us')
    </section>
    <!--contact-us section end-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            @if(session()->has('join-error'))
                window.location.href="{{url('/')}}/#Provider";
            @endif
        })
    </script>
@endsection
