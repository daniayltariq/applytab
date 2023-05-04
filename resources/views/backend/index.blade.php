@extends('backend.layouts.app')

@section('styles')
<style>

    .logo{
        background-color: #485080 !important;
    }
    .stats-icon{
        font-size: 27px;
        color: rgba(47, 54, 95);
    }

    .stats-val{
        color: rgba(47, 54, 95);
    }

    .sidebar-bg{
        background-color: #485080 !important;
    }

    .side-nav .side-nav-inner .side-nav-menu li{
        margin-bottom: 10px;
    }
    .side-nav .side-nav-inner .side-nav-menu li:hover{
        background-color: #f9fbfd;
        border-radius: 16px 0 0 16px;
        margin-left: 0.5rem !important;
        /* margin-right: 0.5rem !important; */
    }

    .side-nav .side-nav-inner .side-nav-menu li.active{
        background-color: #f9fbfd;
        border-radius: 16px 0 0 16px;
        margin-left: 0.5rem !important;
        /* margin-right: 0.5rem !important; */
    }

    .side-nav .side-nav-inner .side-nav-menu li:after{
        border-right: unset;
        border-color: unset;
    }

    .side-nav .side-nav-inner .side-nav-menu,.header .logo{
        border-right: none !important;
    }

    .ps-container.ps-in-scrolling.ps-y>.ps-scrollbar-y-rail{
        background-color: none !important;
    }

    .ps-container.ps-in-scrolling.ps-y>.ps-scrollbar-y-rail>.ps-scrollbar-y{
        background-color: #dedede;
        width: 5px;
    }
</style>
@endsection

@section('content')
    <div class="main-content">
        <div class="row">
            {{-- <div class="col-lg-5">
                <div class="row"> --}}
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="justify-content-between align-items-center">
                                    <p class="m-b-0 text-muted">Clicks</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="fas fa-bullseye stats-icon"></i>
                                        <h2 class="m-b-0 stats-val"> {{$data['clicks'] ?? ''}}</h2>
                                    </div>
                                    {{-- <span class="badge badge-pill badge-cyan font-size-12">
                                        <i class="anticon anticon-arrow-up"></i>
                                        <span class="font-weight-semibold m-{{$alignShortRev}}-5">6.71%</span>
                                    </span> --}}
                                </div>
                                {{-- <div class="m-t-40">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-primary badge-dot m-{{$alignShort}}-10"></span>
                                            <span class="text-gray font-weight-semibold font-size-13">Monthly Goal</span>
                                        </div>
                                        <span class="text-dark font-weight-semibold font-size-13">70% </span>
                                    </div>
                                    <div class="progress progress-sm w-100 m-b-0 m-t-10">
                                        <div class="progress-bar bg-primary" style="width: 70%"></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="justify-content-between align-items-center">
                                    <p class="m-b-0 text-muted">Views</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="fas fa-eye stats-icon"></i>
                                        <h2 class="m-b-0 stats-val">{{$data['views'] ?? ''}}</h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="justify-content-between align-items-center">
                                    <p class="m-b-0 text-muted">Ads</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="fas fa-tasks stats-icon"></i>
                                        <h2 class="m-b-0 stats-val">{{$data['ads'] ?? ''}}</h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="justify-content-between align-items-center">
                                    <p class="m-b-0 text-muted">Sites</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="fas fa-regular fa-building stats-icon"></i>
                                        <h2 class="m-b-0 stats-val">{{$data['sites'] ?? ''}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
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
                    </div>
                {{-- </div>
            </div> --}}
            {{-- <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Requests Statistics</h5>
                        </div>
                        <div class="m-t-30">
                            <div class="d-inline-block m-{{$alignShort}}-30">
                                <p class="m-b-0 d-flex align-items-center">
                                    <span class="badge badge-primary badge-dot m-{{$alignShort}}-10"></span>
                                    <span>Views</span>
                                </p>
                            </div>
                            <div class="d-inline-block">
                                <p class="m-b-0 d-flex align-items-center">
                                    <span class="badge badge-blue badge-dot m-{{$alignShort}}-10"></span>
                                    <span>Clicks</span>
                                </p>
                            </div>
                        </div>
                        <div class="m-t-50">
                            <canvas class="chart" style="height: 205px" id="sales_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>

        <div class="row">
            <div class="col-lg-4 d-none">
                <div class="card">
                    <div class="card-body">
                        <h5>Customers</h5>
                        <div class="m-v-45 text-center" style="height: 220px">
                            <canvas class="chart" id="customer-chart"></canvas>
                        </div>
                        <div class="row p-t-25">
                            <div class="col-md-8 m-h-auto">
                                <div class="d-flex justify-content-between align-items-center m-b-20">
                                    <p class="m-b-0 d-flex align-items-center">
                                        <span class="badge badge-warning badge-dot m-{{$alignShort}}-10"></span>
                                        <span>New</span>
                                    </p>
                                    <h5 class="m-b-0">350</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center m-b-20">
                                    <p class="m-b-0 d-flex align-items-center">
                                        <span class="badge badge-primary badge-dot m-{{$alignShort}}-10"></span>
                                        <span>Pendding</span>
                                    </p>
                                    <h5 class="m-b-0">450</h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center m-b-20">
                                    <p class="m-b-0 d-flex align-items-center">
                                        <span class="badge badge-danger badge-dot m-{{$alignShort}}-10"></span>
                                        <span>old</span>
                                    </p>
                                    <h5 class="m-b-0">100</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/0.6.6/chartjs-plugin-zoom.js"></script>
<script>
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
        blue: '#e31c79',
        blueLight: '#e31c7938',
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

        //line chart
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
                            max: {!!$data['graph-max-y-axis']!!},                            
                            stepSize: {!!$data['graph-max-y-axis'] > 2000 ? 500 : ($data['graph-max-y-axis'] > 500 && $data['graph-max-y-axis'] < 2000  ? 200 :20) !!},
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
