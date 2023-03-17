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
            <li class="nav-item {{url()->current() == route('backend.institution.index') ? 'active' :''}}">
                <a href="{{route('backend.institution.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-building"></i>
                    </span>
                    <span class="title">Institutions </span>
                </a>
            </li>
            <li class="nav-item {{url()->current() == route('backend.job.index') ? 'active' :''}}">
                <a href="{{route('backend.job.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-list-alt"></i>
                    </span>
                    <span class="title">Jobs </span>
                </a>
            </li>

            <li class="nav-item {{url()->current() == route('backend.site.index') ? 'active' :''}}">
                <a href="{{route('backend.site.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-globe"></i>
                    </span>
                    <span class="title">Job Boards</span>
                </a>
            </li>

            <li class="nav-item dropdown {{\Route::is('backend.contract.*') ? 'active' :''}}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fas fa-list-alt"></i>
                    </span>
                    <span class="title">Reports</span>
                    <span class="arrow">
                        <i class="arrow-icon" style="color:#fff"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">Job</a>
                    </li>
                    <li>
                        <a href="#">Institutions</a>
                    </li>
                    {{-- <li>
                        <a href="#">Job Type</a>
                    </li>
                    <li>
                        <a href="#">Region</a>
                    </li> --}}
                </ul>
            </li>

            <li class="nav-item {{\Route::is('backend.view_notifications') ? 'active' :''}}">
                <a href="{{route('backend.view_notifications')}}">
                    <span class="icon-holder">
                        <i class="fas fa-bell"></i>
                    </span>
                    <span class="title">Notifications </span>
                </a>
            </li>

       
            <li class="nav-item {{url()->current() == route('backend.jobstats.index') ? 'active' :''}}">
                <a href="{{route('backend.jobstats.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-list-alt"></i>
                    </span>
                    <span class="title">Job Stats </span>
                </a>
            </li>

            {{-- <li class="nav-item {{url()->current() == route('backend.orders.index') ? 'active' :''}}">
                <a href="{{route('backend.orders.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-tasks"></i>
                    </span>
                    <span class="title">Orders</span>
                </a>

            </li> --}}
            {{-- <hr>
            <li class="nav-item dropdown {{\Route::is('backend.contract.*') ? 'active' :''}}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fas fa-building"></i>
                    </span>
                    <span class="title">Contracts</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('backend.contract.index')}}">All Contracts</a>
                    </li>
                    <li>
                        <a href="{{route('backend.contract.index')}}?type=customer">Customer Contracts</a>
                    </li>
                    <li>
                        <a href="{{route('backend.contract.index')}}?type=vendor">Vendor Contracts</a>
                    </li>
                    <li>
                        <a href="{{route('backend.contract.create')}}">Add Contract</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown {{\Route::is('backend.user.*') ? 'active' :''}}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="fas fa-briefcase"></i>
                    </span>
                    <span class="title">Users & Admins</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('backend.user.index')}}">All Users</a>
                    </li>
                    <li>
                        <a href="{{route('backend.user.index')}}?type=customer">Customer</a>
                    </li>
                    <li>
                        <a href="{{route('backend.user.index')}}?type=vendor">Vendor</a>
                    </li>
                    <li>
                        <a href="{{route('backend.user.index')}}?type=salesperson">Salesperson</a>
                    </li>
                    <li>
                        <a href="{{route('backend.user.index')}}?type=purchaser">Purchaser</a>
                    </li>
                    <li>
                        <a href="{{route('backend.user.index')}}?type=employee">User</a>
                    </li>
                    <li>
                        <a href="{{route('backend.user.create')}}?type=employee">Add New</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{\Route::is('backend.view_notifications') ? 'active' :''}}">
                <a href="{{route('backend.view_notifications')}}">
                    <span class="icon-holder">
                        <i class="fas fa-bell"></i>
                    </span>
                    <span class="title">Notifications </span>
                </a>
            </li> --}}
            
           {{-- <li class="nav-item {{\Route::is('backend.blog.index') ? 'active' :''}}">
                <a href="{{route('backend.blog.index')}}">
                    <span class="icon-holder">
                        <i class="fas fa-blog"></i>
                    </span>
                    <span class="title">Blogs </span>
                </a>
            </li>
             <li class="nav-item">
                <a href="{{route('backend.backend-pages','support')}}">
                    <span class="icon-holder">
                        <i class="fas fa-cog"></i>
                    </span>
                    <span class="title">Support </span>
                </a>
            </li> 
            <li class="nav-item">
                <a href="{{url('/')}}/chatify">
                    <span class="icon-holder">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="title">Chat </span>
                </a>
            </li>--}}
        </ul>
        @endif
    </div>
</div>