@php
    $auth_user=auth()->user();
@endphp
<div class="side-nav sidebar-bg">
    <div class="side-nav-inner">
        @if($auth_user->hasRole('superadmin') || ($auth_user->hasRole('customer')) )
        <ul class="side-nav-menu scrollable">
            <li class="nav-item {{url()->current() == route('backend.dashboard') ? 'active' :''}}">
                <a href="{{route('backend.dashboard')}}">
                    <span class="icon-holder">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="title">Home</span>
                </a>
            </li>
            <hr class="sidehr">
            <li class="nav-item {{url()->full() == route('backend.advertiser.index') ? 'active' :''}}">
                <a href="{{route('backend.advertiser.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-university"></i>
                    </span>
                    <span class="title">Advertisers</span>
                </a>
            </li>
            
            <li class="nav-item {{url()->current() == route('backend.advertiser.create') ? 'active' :''}}">
                <a href="{{route('backend.advertiser.create')}}">
                    <span class="icon-holder">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="title">Create Advertiser</span>
                </a>
            </li>
            <hr class="sidehr">
            <li class="nav-item {{url()->full() == route('backend.adsListing') ? 'active' :''}}">
                <a href="{{route('backend.adsListing')}}">
                    <span class="icon-holder">
                        <i class="fas fa-list-alt"></i>
                    </span>
                    <span class="title">Ads Directory</span>
                </a>
            </li>

            <li class="nav-item {{url()->full() == route('backend.adsListing',['q'=>'archived']) ? 'active' :''}}">
                <a href="{{route('backend.adsListing',['q'=>'archived'])}}">
                    <span class="icon-holder">
                        <i class="fas fa-list-alt"></i>
                    </span>
                    <span class="title">Archived Ads</span>
                </a>
            </li>
            <li class="nav-item {{url()->full() == route('backend.adsListing',['q'=>'active']) ? 'active' :''}}">
                <a href="{{route('backend.adsListing',['q'=>'active'])}}">
                    <span class="icon-holder">
                        <i class="fas fa-list-alt"></i>
                    </span>
                    <span class="title">Active Ads</span>
                </a>
            </li>

            <li class="nav-item {{url()->current() == route('backend.adCreate') ? 'active' :''}}">
                <a href="{{route('backend.adCreate')}}">
                    <span class="icon-holder">
                        <i class="fas fa-globe"></i>
                    </span>
                    <span class="title">Ad Create</span>
                </a>
            </li>
            <hr class="sidehr">
            <li class="nav-item {{-- {{url()->current() == route('backend.adsListing') ? 'active' :''}} --}}">
                <a href="{{route('backend.adstats.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-chart-bar"></i>
                    </span>
                    <span class="title">Analytics </span>
                </a>
            </li>
        </ul>
        @endif
    </div>
</div>
