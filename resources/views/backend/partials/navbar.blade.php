<div class="header">
    <div class="logo logo-dark">
        <a href="index.html" style="margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        width: inherit">
            <h1 class="logo-unfold"><span class="text-color1">ApplyTab</span></h1>
            <h1 class="logo-fold"><span class="text-color1">A</span><span class="text-color2">T</span></h1>
        </a>
    </div>
    <div class="logo logo-white">
        <a href="index.html" style="margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        width: inherit">
            <h1><span class="text-color1">C</span><span class="text-color2"> M</span></h1>
        </a>
    </div>
    <div class="nav-wrap">
        <ul class="nav-left">
            <li class="desktop-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li class="mobile-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            {{-- <li>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                    <i class="anticon anticon-search"></i>
                </a>
            </li> --}}
        </ul>
        <ul class="nav-right">
            {{-- <li class="dropdown dropdown-animated scale-left">
                <a href="javascript:void(0);" data-toggle="dropdown">
                    <img src="https://stripe.com/img/flags/us.png"></span> <span class="caret-lang"></span>
                </a>
                <ul class="dropdown-menu __lang">
                    <li class="pd-lang"><a href="{{url('/lang/en')}}"><img src="https://stripe.com/img/flags/us.png"></a></li>
                </ul>
            </li> --}}
            <li class="dropdown dropdown-animated scale-left">
                <a href="javascript:void(0);" data-toggle="dropdown">
                    <i class="anticon anticon-bell notification-badge"></i>
                </a>
                <div class="dropdown-menu pop-notification">
                    <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                        <p class="text-dark font-weight-semibold m-b-0">
                            <i class="anticon anticon-bell"></i>
                            <span class="m-{{$alignShortRev}}-10">Notification</span>
                        </p>
                        <a class="btn-sm btn-default btn" href="{{route('backend.view_notifications')}}">
                            <small>View All</small>
                        </a>
                    </div>
                    <div class="relative" id="notify_div">
                        
                    </div>
                    
                    <div class="p-v-15 p-h-25 border-top d-flex justify-content-center align-items-center"><a href="{{route('backend.mark_notifications')}}">mark as read</a></div>
                </div>
            </li>
            <li class="dropdown dropdown-animated scale-left">
                <div class="pointer" data-toggle="dropdown">
                    <div class="avatar avatar-image  m-h-10 m-r-15">
                        {{-- <img src="{{asset('backend/assets/images/avatars/user.jpg')}}" alt=""> --}}
                        <i class="fa fa-user text-primary"></i>
                    </div>
                </div>
                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex">
                            <div class="avatar avatar-lg avatar-image">
                                {{-- <img src="{{asset('backend/assets/images/avatars/user.jpg')}}" alt=""> --}}
                                <i class="fa fa-user text-primary"></i>
                            </div>
                            <div class="m-{{$alignShortRev}}-10">
                                <p class="m-b-0 text-dark font-weight-semibold">{{auth()->user()->name}}</p>
                                <p class="m-b-0 opacity-07">Admin</p>
                            </div>
                        </div>
                    </div>
                    {{-- <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                </div>
                                <div class="col-auto">
                                    <span class="">Edit Profile</span>
                                </div>
                                
                            </div>
                            <i class="anticon font-size-10 anticon-{{$alignreverse}}"></i>
                        </div>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="anticon opacity-04 font-size-16 anticon-lock"></i>
                                </div>
                                <div class="col-auto">
                                    <span class="">Account Setting</span>
                                </div>
                            </div>
                            <i class="anticon font-size-10 anticon-{{$alignreverse}}"></i>
                        </div>
                    </a> --}}
                    {{-- <a href="{{route('backend.password.update')}}" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="anticon opacity-04 ft-size-17 anticon-lock"></i>
                                </div>
                                <div class="col-auto">
                                    <span class="">Update Password</span>
                                </div>
                            </div>
                            <i class="anticon font-size-10 anticon-{{$alignreverse}}"></i>
                        </div>
                    </a> --}}
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="anticon opacity-04 ft-size-17 anticon-logout"></i>
                                </div>
                                <div class="col-auto">
                                    <span class="">Logout</span>
                                </div>
                            </div>
                            <i class="anticon font-size-10 anticon-{{$alignreverse}}"></i>
                        </div>
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                </div>
            </li>
        </ul>
    </div>
</div>