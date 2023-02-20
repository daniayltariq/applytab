@extends('backend.layouts.app')

@section('styles')
	<style>
		.error{
			color: red;
		}

        #delete_req_btn{
            display: none;
        }

        .kt-widget3__item:hover #delete_req_btn{
            display: inline;
        }

        .h-37{
            height: 37px;
        }
	</style>
@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <div class="col-xl-12 col-lg-12 order-lg-12 order-xl-1">
        <!--begin:: Widgets/Support Tickets -->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        User Request
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more-1"></i>
                        </button>
                        {{-- <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                            <!--begin::Nav-->
                            <ul class="kt-nav">
                                <li class="kt-nav__head">
                                    Export Options                                    
                                    <span data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand kt-svg-icon--md1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                                <rect id="Rectangle-9" fill="#000000" x="11" y="10" width="2" height="7" rx="1"/>
                                                <rect id="Rectangle-9-Copy" fill="#000000" x="11" y="7" width="2" height="2" rx="1"/>
                                            </g>
                                        </svg>
                                    </span>
                                </li>
                                <li class="kt-nav__separator"></li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-drop"></i>
                                    <span class="kt-nav__link-text">Activity</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                    <span class="kt-nav__link-text">FAQ</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                    <span class="kt-nav__link-text">Settings</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                    <span class="kt-nav__link-text">Support</span>
                                    <span class="kt-nav__link-badge">
                                    <span class="kt-badge kt-badge--success kt-badge--rounded">5</span>
                                    </span>
                                    </a>
                                </li>
                                <li class="kt-nav__separator"></li>
                                <li class="kt-nav__foot">
                                    <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>                                    
                                    <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                </li>
                            </ul>
                            <!--end::Nav-->             
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget3">
                    @foreach ($requests as $request)
                        <div class="kt-widget3__item">
                            <div class="kt-widget3__header">
                                <div class="kt-widget3__user-img">                           
                                    <img  data-name="{{$request->user->f_name ?? ''}}" class="demo" >  
                                </div>
                                <div class="kt-widget3__info">
                                    <a href="#" class="kt-widget3__username">
                                        {{$request->user->f_name ?? ''}} {{$request->user->l_name ?? ''}}  
                                    </a><br> 
                                    <span class="kt-widget3__time">
                                        {{$request->created_at->diffForHumans() ?? ''}}
                                    </span>      
                                </div>
                                <span class="kt-widget3__status kt-font-info h-37">
                                    @if ($request->accepted==0)
                                        <form action="{{route('backend.user.accept_request',$request->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="user_id" value="{{$request->user_id}}">
                                            <button type="submit" class="btn btn-info">Accept</button>
                                        </form>
                                        
                                    @else
                                        <i>request accepted</i>
                                    @endif

                                    <br><br>
                                    <div id="delete_req_btn">@include('components.delete' , ['data' => $request->id, 'route' => 'backend.user.delete_request'])</div> 
                                </span> 
                            </div>
                            <div class="kt-widget3__body">
                                <h5>{{$request->subject ?? ''}}</h5>
                                <p class="kt-widget3__text"> 
                                    {!!$request->message ?? ''!!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--end:: Widgets/Support Tickets -->   
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{asset('backend-assets/assets/vendors/general/initial-js/initial.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.demo').initial({width:60,height:60});
        })
        

    </script>
@endsection