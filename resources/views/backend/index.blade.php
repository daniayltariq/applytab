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
                                        <h2 class="m-b-0 stats-val">USD {{$data['revenue'] ?? ''}}</h2>
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
                                        <h2 class="m-b-0 stats-val">{{$data['vendors'] ?? ''}}</h2>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="justify-content-between align-items-center">
                                    <p class="m-b-0 text-muted">Jobs</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="fas fa-tasks stats-icon"></i>
                                        <h2 class="m-b-0 stats-val">{{$data['orders'] ?? ''}}</h2>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="justify-content-between align-items-center">
                                    <p class="m-b-0 text-muted">Institutes</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="fas fa-regular fa-building stats-icon"></i>
                                        <h2 class="m-b-0 stats-val">{{$data['customers'] ?? ''}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Requests Statistics</h5>
                        </div>
                        <div class="m-t-30">
                            <div class="d-inline-block m-{{$alignShort}}-30">
                                <p class="m-b-0 d-flex align-items-center">
                                    <span class="badge badge-primary badge-dot m-{{$alignShort}}-10"></span>
                                    <span>Completed Contracts</span>
                                </p>
                            </div>
                            <div class="d-inline-block">
                                <p class="m-b-0 d-flex align-items-center">
                                    <span class="badge badge-blue badge-dot m-{{$alignShort}}-10"></span>
                                    <span>Uncompleted Contracts</span>
                                </p>
                            </div>
                        </div>
                        <div class="m-t-50">
                            <canvas class="chart" style="height: 205px" id="sales_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Top Vendors</h5>
                        </div>
                        <div class="m-t-30">
                            <ul class="list-group list-group-flush">
                                @foreach ($top_services as $ser)
                                    <li class="list-group-item p-h-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex">
                                                <div class="avatar avatar-image m-{{$alignShort}}-15">
                                                    <img src="assets/images/others/thumb-9.jpg" alt="">
                                                </div>
                                                <div>
                                                    <h6 class="m-b-0">
                                                        <a href="javascript:void(0);" class="text-dark">{{$ser->service_data->category_name ?? ''}}</a>
                                                    </h6>
                                                    <span class="text-muted font-size-13">{{$ser->company->name ?? ''}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                

                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Revenue</h5>
                        </div>
                        <div class="m-t-30">
                            <div class="d-md-flex">
                                <div class="p{{$alignShort}}-4 m-v-10 border-hide-md">
                                    <p class="m-b-0">Net Revenue</p>
                                    <h3 class="m-b-0">
                                        <span>{{danishFormat($data['revenue'] ?? '')}}</span>
                                    </h3>
                                </div>
                                <div class="px-md-4 m-v-10">
                                    <p class="m-b-0">Profit</p>
                                    <h3 class="m-b-0">
                                        <span>$17,523</span>
                                        <span class="text-danger m-{{$alignShortRev}}-10 font-size-14">+1.82%</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-50" style="height: 240px">
                            <canvas class="chart" id="revenue_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Recent Jobs</h5>
                            {{-- <div>
                                <a href="javascript:void(0);" class="btn btn-sm btn-default">View All</a>
                            </div> --}}
                        </div>
                        <div class="m-t-30">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="bold">Posting no</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Institute</th>
                                            <th>Entry date</th>
                                            <th>Status</th>
                                            {{-- <th>Renewal date</th>
                                            <th>Renewal Deadline date</th>
                                            <th>Contract value</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recent_contracts as $key => $contract)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td class="name-badge p-3">{{ $contract->user_type ?? '' }}</td>
                                                <td>{{ $contract->association->name ?? '' }}</td>
                                                <td>{{ $contract->start_date ?? '' }}</td>
                                                <td>{{ $contract->end_date ?? '' }}</td>
                                                {{-- <td class="{{\Carbon\Carbon::parse($contract->renewal_date)->lt(now()) ? 'text-danger' : ''}}">{{ $contract->renewal_date ?? '' }}</td>
                                                <td>{{ $contract->renewal_reminder_date ?? '' }}</td>
                                                <td>{{ $contract->contract_value ?? '' }}</td> --}}
                                                
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No Jobs found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
        /* const revenueChartConfig = new Chart(document.getElementById("revenue_chart"), {
            type: 'line',
            data: {
                labels: {!!$graph->pluck('months')!!},
                datasets: [{
                    label: 'Revenue',
                    backgroundColor: colors.transparent,
                    borderColor: colors.blue,
                    pointBackgroundColor: colors.blue,
                    pointBorderColor: colors.white,
                    pointHoverBackgroundColor: colors.blueLight,
                    pointHoverBorderColor: colors.blueLight,
                    data: {!!$graph->pluck('revenue')!!}
                }]
            },
            options: {
                legend: {
                    display: false
                },
                maintainAspectRatio: false,
                responsive: true,
                
                tooltips: {
                    mode: 'index'
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
                            padding: 10
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
                            min:0,
                            max: 2000,                            
                            stepSize: 200,
                            fontColor: colors.grayLight,
                            fontSize: 13,
                            padding: 10
                        }  
                    }],
                },
                zoom: {
                    enabled: true,
                    mode: 'xy',
                },
            }
        }); */

        const salesChart = document.getElementById("sales_chart");
        const salesChartCtx = salesChart.getContext('2d');
        salesChart.height = 120;
        const salesChartConfig = new Chart(salesChartCtx, {
            type: 'bar',
            data: {
            labels: [ 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            datasets: [{
                label: 'Online',
                backgroundColor: colors.blue,
                borderWidth: 0,
                data: [ 20, 30, 35, 45, 55, 45]
            },
            {
                label: 'Offline',
                backgroundColor: colors.blueLight,
                borderWidth: 0,
                data: [ 25, 35, 40, 50, 60, 50]
                }]
            },
            options: {
                scaleShowVerticalLines: false,
                responsive: true,
                legend: {
					display: false
				},
                scales: {
                    xAxes: [{
                        categoryPercentage: 0.35,
                        barPercentage: 0.70,
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Month'
                        },
                        gridLines: false,
                        ticks: {
                            display: true,
                            beginAtZero: true,
                            fontSize: 13,
                            padding: 10
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'Value'
                        },
                        gridLines: {
                            drawBorder: false,
                            offsetGridLines: false,
                            drawTicks: false,
                            borderDash: [3, 4],
                            zeroLineWidth: 1,
                            zeroLineBorderDash: [3, 4]
                        },
                        ticks: {
                            max: 80,                            
                            stepSize: 20,
                            display: true,
                            beginAtZero: true,
                            fontSize: 13,
                            padding: 10
                        }
                    }]
                }
            }
        });
    })
</script>
    
@endsection