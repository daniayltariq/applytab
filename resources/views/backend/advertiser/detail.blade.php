@extends('backend.layouts.app')

@section('styles')
<style>
    th{
        font-weight: 700 !important;
    }

    /* The side navigation menu */
	.sidenav {
		height: 90%; /* 100% Full-height */
		width: 0; /* 0 width - change this with JavaScript */
		position: fixed; /* Stay in place */
		z-index: 1;
		top: 80px;
		right: 0;
		background-color: #fff;
		box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%);
		overflow-x: hidden;
		padding-top: 60px;
		transition: 0.5s;
	}

		/* The navigation menu links */
	.sidenav a {
		padding: 8px 8px 8px 32px;
		text-decoration: none;
		font-size: 25px;
		color: #818181;
		display: block;
		transition: 0.3s;
	}

	/* When you mouse over the navigation links, change their color */
	.sidenav a:hover {
		color: #f1f1f1;
	}

	/* Position and style the close button (top right corner) */
	.sidenav .closebtn {
		position: absolute;
		top: 0;
		right: 25px;
		font-size: 36px;
		margin-left: 50px;
	}

    .detail{
        font-size: 16px;
    }

    .detail-bold{
        font-size: 16px;
        font-weight: bolder;
    }
    
	@media screen and (max-height: 450px) {
		.sidenav {padding-top: 15px;}
		.sidenav a {font-size: 18px;}
	}
    @media screen and (max-width:767px){
		.sidenav {
			top:10px;
		}
	}

	@media screen and (max-width:991px){
		.sidenav {
			height: 90%;
		}
    }

    .fa, .fas{
        line-height: unset !important;
    }

    .dropdown-item{
        cursor: pointer;
    }
</style>
@endsection

@section('content')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            {{-- <h2 class="header-title">Ad Statistics</h2> --}}
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="{{route('backend.advertiser.index')}}" class="breadcrumb-item"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Advertisers</a>
                    <span class="breadcrumb-item active">Advertiser Statistics</span>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center">
                            <p class="m-b-0 text-muted">Total Ads</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="fas fa-list-alt stats-icon"></i>
                                <h2 class="m-b-0 stats-val">{{$stats['total_ads']}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center">
                            <p class="m-b-0 text-muted">Active Ads</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="fas fa-eye stats-icon"></i>
                                <h2 class="m-b-0 stats-val">{{$stats['active_ads']}}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center">
                            <p class="m-b-0 text-muted">Archived Ads</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="fas fa-regular fa-archive stats-icon"></i>
                                <h2 class="m-b-0 stats-val">{{$stats['archived_ads']}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center">
                            {{-- @php
                                $clicks=isset($stats['clicks']) ? $stats['clicks'] : 0;
                                $cost=$clicks ? number_format(($ad->cost_per_click/$clicks),2, '.', '') : 0;
                            @endphp --}}
                            <p class="m-b-0 text-muted">Total Spending</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="fas fa-money-bill stats-icon"></i>
                                <h2 class="m-b-0 stats-val">$ {{$stats['total_amount']}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card View -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="media m-v-10  d-flex ">
                            <div class="avatar avatar-cyan avatar-icon avatar-square">
                                <i class="fas fa-ad"></i>
                            </div>
                            <div class="media-body my-auto m-{{$alignShortRev}}-15">
                                <h4 class="card-title font-size-22 p-0">Active Ads</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Ad Image</th>
                                    <th scope="col">Job Boards</th>
                                    <th scope="col">Impressions</th>
                                    <th scope="col">Clicks</th>
                                    <th scope="col">CPC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($active_ads as $key => $item)
                                        <tr>
                                            <td><img width="150px" src="{{ $item->image }}"/></td>
                                            <td>
                                                @foreach ($item->adSites as $site)
                                                    <span class="badge rounded-pill bg-primary text-color1 mb-1 mt-1 px-2 py-1">{{str_replace('/', '', $site->site_name)}}</span>
                                                @endforeach
                                            </td>
                                            <td>{{$item->ad_stats()->where('type','view')->count()}}</td>
                                            <td>
                                                @php
                                                    $clicks=$item->ad_stats()->where('type','click')->count();
                                                @endphp
                                                {{$clicks}}
                                            </td>
                                            <td>
                                                @php
                                                    $cost=$clicks ? number_format(($item->cost_per_click/$clicks),2, '.', '') : 0;
                                                @endphp
                                                ${{$cost}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="media m-v-10  d-flex ">
                            <div class="avatar avatar-cyan avatar-icon avatar-square">
                                <i class="fas fa-ad"></i>
                            </div>
                            <div class="media-body my-auto m-{{$alignShortRev}}-15">
                                <h4 class="card-title font-size-22 p-0">Advertiser history</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Ad Image</th>
                                    <th scope="col">Job Boards</th>
                                    <th scope="col">Impressions</th>
                                    <th scope="col">Clicks</th>
                                    <th scope="col">CPC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($archived_ads as $key => $item)
                                        <tr>
                                            <td><img width="150px" src="{{ $item->image }}"/></td>
                                            <td>
                                                @foreach ($item->adSites as $site)
                                                    <span class="badge rounded-pill bg-primary text-color1 mb-1 mt-1 px-2 py-1">{{str_replace('/', '', $site->site_name)}}</span>
                                                @endforeach
                                            </td>
                                            <td>{{$item->ad_stats()->where('type','view')->count()}}</td>
                                            <td>
                                                @php
                                                    $clicks=$item->ad_stats()->where('type','click')->count();
                                                @endphp
                                                {{$clicks}}
                                            </td>
                                            <td>
                                                @php
                                                    $cost=$clicks ? number_format(($item->cost_per_click/$clicks),2, '.', '') : 0;
                                                @endphp
                                                ${{$cost}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		
	});

</script>

@endsection