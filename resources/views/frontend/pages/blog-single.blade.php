@extends('frontend.layouts.app')

@section('styles')
<link rel="manifest" href="{{asset('frontend/assets/favicon/site.webmanifest')}}">
@endsection
@section('content')
    
    <!--hero section start-->
    <section class="hero blog_hero">
        <div class="hero__wrapper blog_hero__wrapper">
            <div class="container">
                <div class="row">
                    <div>
                        <h1>Our blog.</h1>
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
                </div>
            </div>
        </div>
    </section>
    <!--hero section end-->

    <!--blog single start-->
    <section class="blog_single">
        <div class="blog_single__wrapper">
            <div class="container">
                <div class="blog_single__thumbnail">
                    <img src="{{asset($post->image ?? '')}}" alt="image">
                </div>
                <div class="blog_single__content">
                    <h1>{{$post->title ?? ''}}</h1>
                    <h4>{{$post->created_at}}</h4>
                    <div>
                        <p>{!!$post->long_desc ?? '' !!}</p>
                    </div>
                </div>
            </div>
            <div class="blog_related">
                <div class="blog_related__wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="blog_related__header">
                                <h3>Related posts</h3>
                                <div class="screenshot-nav related-post-nav">
                                    <div class="screenshot-nav-prev"><i class="fad fa-long-arrow-left"></i></div>
                                    <div class="screenshot-nav-next"><i class="fad fa-long-arrow-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="swiper-container blog_related-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($recent_posts as $key => $r)
                                        <div class="swiper-slide blog_related-slide">
                                            <a href="blog-single.html">
                                                <div class="blog__single blog_related-single blog_related-single--1">
                                                    <div class="blog__single-image">
                                                        <img src="{{asset($r->image ?? '')}}" alt="image">
                                                    </div>
                                                    <div class="blog__single-info">
                                                        <h3>{{$r->title ?? ''}}</h3>
                                                        <h4>{{$r->created_at}}</h4>
                                                        <p class="paragraph dark">{{$r->short_desc ?? ''}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                    {{-- <div class="swiper-slide blog_related-slide">
                                        <a href="blog-single.html">
                                            <div class="blog__single blog_related-single blog_related-single--2">
                                                <div class="blog__single-image">
                                                    <img src="{{asset('frontend/assets/images/related-blog-img-2.png')}}" alt="image">
                                                </div>
                                                <div class="blog__single-info">
                                                    <h3>Day upon after all fowl let deep seas.</h3>
                                                    <h4>12 <i class="fad fa-comment"></i><span>|</span>Dec 17,2020</h4>
                                                    <p class="paragraph dark">Of may gathered you're. Firmament. Wherein to to sixth there moveth to what firmament fruitful ...
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--blog single end-->
@endsection