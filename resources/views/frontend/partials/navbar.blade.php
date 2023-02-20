<header class="header header-1">
    <div class="container">
        <div class="header__wrapper">
            <div class="header__logo">
                <a href="{{route('/')}}">

                    <img src="{{asset('frontend/assets/images/footer-logo.svg')}}" alt="logo">
                </a>
            </div>
            <div class="header__nav">
                <ul class="header__nav-primary">
                    <li><a href="{{route('/')}}"><i class="fad fa-home-lg"></i></a></li>
                    <li><a href="#intro">@lang('intro')</a></li>
                    <li><a href="#Provider">@lang('join us')</a></li>
                    <li><a href="#feature">@lang('features')</a></li>
                    <li><a href="#faq">@lang('FAQs')</a></li>
                    <li><a href="#blog">@lang('blog')</a></li>
                    <li><a href="#contact">@lang('contact us')</a></li>
                    <a href="{{route('login')}}" class="button">@lang('login') <i class="fad fa-user"></i></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if ($lang) @lang('Arabic') @else English @endif
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/lang/en')}}">English</a>
                            <a class="dropdown-item" href="{{url('/lang/ar')}}">@lang('Arabic')</a>
                        </li>
                </ul>
                <span><i class="fas fa-times"></i></span>
            </div>
            <div class="header__bars">
                <div class="header__bars-bar header__bars-bar-1"></div>
                <div class="header__bars-bar header__bars-bar-2"></div>
                <div class="header__bars-bar header__bars-bar-3"></div>
            </div>
        </div>
    </div>
</header>