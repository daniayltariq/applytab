<div class="related-blog__wrapper">
    <h2 class="section-heading">@lang('blog_section_heading_1')</h2>
    <div class="blog__content">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $key => $blog)
                    <div class="col-lg-{{$loop->first ?'4' :'8'}}">
                        <a href="{{route('blog.show',$blog->slug)}}">
                            <div class="blog__single blog__single--{{$key+1}}">
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
                </div> --}}
            </div>
        </div>
    </div>
    <a href="{{route('page','blog')}}" class="button">
        <span>@lang('GO TO BLOG') <i class="
            @if ($lang)
                fad fa-long-arrow-left
                @else
                fad fa-long-arrow-right
                @endif"></i>
            </span>
    </a>
</div>