@extends('frontend.layouts.app')

@section('content')
    <!--hero section start-->
    <section class="hero blog_hero">
        <div class="hero__wrapper blog_hero__wrapper">
            <div class="container">
                <div class="row">
                    <div>
                        <h1>Blog and News</h1>
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

    <!--blog start-->
    <section class="blog">
        <div class="blog__wrapper">
            <div class="container">
                <div class="blog__header">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="category__dropdown dropdown-wrapper">
                                <div class="category__dropdown-info dropdown-info">
                                    <h6>Category</h6>
                                    <i class="fad fa-angle-double-down"></i>
                                </div>
                                <div class="category__dropdown-box dropdown-box">
                                    <ul>
                                        @foreach ($categories as $cat)
                                            <li>{{$cat->category_name ?? ''}}</li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="date__dropdown dropdown-wrapper">
                                <div class="date__dropdown-info dropdown-info">
                                    <h6>Date</h6>
                                    <i class="fad fa-angle-double-down"></i>
                                </div>
                                <div class="date__dropdown-box dropdown-box">
                                    
                                    <ul>
                                        @foreach (\Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->subYear(1), '1 month', \Carbon\Carbon::now()) as $month)
                                            <li>{{$month->format('F Y')}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="search">
                                <input type="text" placeholder="Search" class="input-field">
                                <i class="fad fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog__content">
                <div class="container">
                    <div class="row">
                        @php
                           $order=array(4,8);
                        @endphp
                        @foreach ($blogs as $blog)
                                
                            <div class="col-lg-{{$loop->odd ? $order[0].' left' : $order[1]}}">
                                <a href="{{route('blog.show',$blog->slug)}}">
                                    <div class="blog__single blog__single--1">
                                        <div class="blog__single-image">
                                            <img src="{{asset($blog->image ?? '')}}" alt="image">
                                        </div>
                                        <div class="blog__single-info">
                                            <h3>{{$blog->title ?? ''}}</h3>
                                            <h4>{{$blog->created_at}}</h4>
                                            <p class="paragraph dark">{{$blog->short_desc ?? ''}} </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @if ($loop->even)
                                @php
                                    [$order[0], $order[1]] = [$order[1], $order[0]];
                                @endphp
                            @endif
                        @endforeach
                        
                        {{-- <div class="col-lg-8">
                            <a href="{{route('page','blog-single')}}">
                                <div class="blog__single blog__single--2">
                                    <div class="blog__single-image">
                                        <img src="{{asset('frontend/assets/images/blog-img-2.png')}}" alt="image">
                                    </div>
                                    <div class="blog__single-info">
                                        <h3>New features coming in 2020 to our app.</h3>
                                        <h4>12 <i class="fad fa-comment"></i><span>|</span>Dec 17, 2020</h4>
                                        <p class="paragraph dark">Suisque metus tortor ultricies ac ligula neced eleifend dales felise morbi nec tempor isvel ultricies lideula. </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-8 left">
                            <a href="{{route('page','blog-single')}}">
                                <div class="blog__single blog__single--3">
                                    <div class="blog__single-image">
                                        <img src="{{asset('frontend/assets/images/blog-img-3.png')}}" alt="image">
                                    </div>
                                    <div class="blog__single-info">
                                        <h3>New features coming in 2020 to our app.</h3>
                                        <h4>12 <i class="fad fa-comment"></i><span>|</span>Dec 17, 2020</h4>
                                        <p class="paragraph dark">Suisque metus tortor ultricies ac ligula neced eleifend dales felise morbi nec tempor isvel ultricies lideula. </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <a href="{{route('page','blog-single')}}">
                                <div class="blog__single blog__single--4">
                                    <div class="blog__single-image">
                                        <img src="{{asset('frontend/assets/images/blog-img-4.png')}}" alt="image">
                                    </div>
                                    <div class="blog__single-info">
                                        <h3>New features coming in 2020 to our app.</h3>
                                        <h4>12 <i class="fad fa-comment"></i><span>|</span>Dec 17, 2020</h4>
                                        <p class="paragraph dark">Suisque metus tortor ultricies ac ligula neced eleifend dales felise morbi nec tempor isvel ultricies lideula. </p>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- <a href="#" class="button">
                <span>LOAD MORE <i class="fad fa-long-arrow-right"></i></span>
            </a> --}}
        </div>
    </section>
    <!--blog end-->
@endsection