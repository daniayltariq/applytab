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

    #filter:focus{
        box-shadow: none !important;
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

        <div class="card">
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-md-2">
                        <form action="" id="filter_form">
                            <select id="filter" name="filter" class="form-control border-0">
                                <option value="7-days" {{request()->query('filter')=='7-days' ? 'selected' :''}}>Last 7 Days</option>
                                <option value="14-days" {{request()->query('filter')=='14-days' ? 'selected' :''}}>Last 14 Days</option>
                                <option value="30-days" {{request()->query('filter')=='30-days' ? 'selected' :''}}>Last 30 Days</option>
                                <option value="this-month" {{request()->query('filter')=='this-month' ? 'selected' :''}}>This Month</option>
                                <option value="last-month" {{request()->query('filter')=='last-month' ? 'selected' :''}}>Last Month</option>
                            </select>
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <canvas class="chart" style="height: 205px" id="line-chart"></canvas>
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
	
    const colors = {
        magenta: '#eb2f96',
        magentaLight: 'rgba(235, 47, 150, 0.05)',
        red: '#de4436',
        redLight: 'rgba(222, 68, 54, 0.05)',
        volcano: '#fa541c',
        volcanoLight: 'rgba(250, 84, 28, 0.05)',
        orange: '#fa8c16',
        orangeLight: 'rgba(250, 140, 22, 0.1)',
        gold: '#ffc107',
        goldLight: 'rgba(255, 193, 7, 0.1)',
        lime: '#a0d911',
        limeLight: 'rgba(160, 217, 17, 0.1)',
        green: '#52c41a',
        greenLight: 'rgba(82, 196, 26, 0.1)',
        cyan: "#05c9a7",
        cyanLight: 'rgba(0, 201, 167, 0.1)',
        blue: '#5661b3',
        blueLight: '#5661b338',
        geekBlue: '#2f54eb',
        geekBlueLight: 'rgba(47, 84, 235, 0.1)',
        purple: '#886cff',
        purpleLight: 'rgba(136, 108, 255, 0.1)',
        gray: '#53535f',
        grayLight: '#77838f',
        grayLighter: '#ededed',
        grayLightest: '#f1f2f3',
        border: '#edf2f9',
        white: '#ffffff',
        dark: '#2a2a2a',
        transparent: 'rgba(255, 255, 255, 0)'
    };
    $(document).ready(function(){

        $('#filter').on('change', function(){
            $('#filter_form').submit();
        })
        //Line Chart
        const lineChart = document.getElementById("line-chart");
        const lineCtx = lineChart.getContext('2d');
        lineChart.height = 120;
        const lineConfig = new Chart(lineCtx, {
            type: 'line',
            data: {
            // labels: ["January", "February", "March", "April", "May", "June", "July"],
            labels: {!!json_encode($filter)!!},
            datasets: [{
                    label: 'Impressions',
                    backgroundColor: colors.transparent,
                    borderColor: colors.blue,
                    pointBackgroundColor: colors.blue,
                    pointBorderColor: colors.white,
                    pointHoverBackgroundColor: colors.blueLight,
                    pointHoverBorderColor: colors.blueLight,
                    data: {!!json_encode(collect($monthlyStats)->pluck('impressions')->toArray())!!}
                },
                {
                    label: 'Clicks',
                    backgroundColor: colors.transparent,
                    borderColor: colors.cyan,
                    pointBackgroundColor: colors.cyan,
                    pointBorderColor: colors.white,
                    pointHoverBackgroundColor: colors.cyanLight,
                    pointHoverBorderColor: colors.cyanLight,
                    data: {!!json_encode(collect($monthlyStats)->pluck('clicks')->toArray())!!}
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{ 
                        gridLines: [{
                            display: false,
                        }],
                        ticks: {
                            display: true,
                            fontColor: colors.grayLight,
                            fontSize: 13,
                            padding: 10,
                            autoSkip: true,
                            maxTicksLimit: 20
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            drawTicks: false,
                            borderDash: [3, 4],
                            zeroLineWidth: 1,
                            zeroLineBorderDash: [3, 4]  
                        },
                        ticks: {
                            display: true,
                            max: {!!$stats['graph-max-y-axis']!!},                            
                            stepSize: {!!$stats['graph-max-y-axis'] > 2000 ? 500 : ($stats['graph-max-y-axis'] > 500 && $stats['graph-max-y-axis'] < 2000  ? 200 :20) !!},
                            fontColor: colors.grayLight,
                            fontSize: 13,
                            padding: 10,
                        }  
                    }],
                },
            }
        });
    })

</script>

@endsection