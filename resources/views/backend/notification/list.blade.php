@extends('backend.layouts.app')
@section('meta')
<title>{{ config('app.name') }} | Dashboard</title>

@section('styles')
<style type="text/css"> 
    .fa{
        line-height: unset !important;
    }
</style>
@endsection

@section('content')
<div class="main-content">

    <div class="page-header">
        <h2 class="header-title">Notifications</h2>
        <div class="header-sub-title">
            <nav class="breadcrumb breadcrumb-dash">
                <a href="{{route('backend.dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Home</a>
                <a class="breadcrumb-item" href="{{route('backend.view_notifications')}}">Notifications</a>
                <span class="breadcrumb-item active">List</span>
            </nav>
        </div>
    </div>
    @php
    $icon=array(
            "contract"=>"tag",
            "guest"=>"user",
            "refund"=>"hand-holding-usd",
            "dispute"=>"exclamation-triangle",
            "info"=>"info-circle",
        );
    @endphp
    <div class="card mb-4">
        <div class="card-body">
            <h2>Today</h2>
            <div class="list-group list-group-flush">
                @foreach ($today as $notify)
                    @php
                        $keys_exist= $notify->type && $notify->object ? true :false; 
                    @endphp
                    <a href="javascript:void(0)" @if($keys_exist) {{-- target="_blank" --}} @endif class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center" data-original-title="" title="">
                            <div>
                            
                                <span class="avatar"><i class="fa fa-{{$icon[$notify->type ?? 'info'] ?? ''}} text-primary"></i></span>
                            </div>
                            <div class="flex-fill ml-3">
                                <h6 class="fs-15 font-weight-600 mb-0">{{$notify->title ?? ''}} <small class="float-right text-muted">{{\Carbon\Carbon::parse($notify->created_at ?? '')->diffForHumans()}}</small></h6>
                                <p class="mb-0">{{$notify->body ?? ''}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2>Earlier</h2>
            <hr>
            <div class="list-group list-group-flush">
                @foreach ($earlier as $single)
                        @php
                            $keys_exist= $single->type && $single->object ? true :false; 
                        @endphp
                        <a href="javascript:void(0)" @if($keys_exist) {{-- target="_blank" --}} @endif class="list-group-item list-group-item-action">
                            <div class="d-flex align-items-center" data-original-title="" title="">
                                <div>
                                    <span class="avatar"><i class="fa fa-{{$icon[$single->type ?? 'info'] ?? ''}} text-primary"></i></span>
                                </div>
                                <div class="flex-fill ml-3">
                                    <h6 class="fs-15 font-weight-600 mb-0">{{$single->title ?? ''}} <small class="float-right text-muted">{{\Carbon\Carbon::parse($single->created_at ?? '')->diffForHumans()}}</small></h6>
                                    <p class="mb-0">{{$single->body ?? ''}}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                   <hr>
                   {{ $earlier->appends($_GET)->links() }}
            
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')

<script>
    $(document).ready(function(){
    })

</script>
@endsection