<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.partials.header')

    <link href="{{ asset('backend-assets/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <style>
        .icon_box i {
            color: #f4c21b;
        }

        .bg-white {
            background: white;
        }

        .p-0 {
            padding: 0 !important;
        }

        .reports-info img {
            height: 20px;
        }

        .reports-info td {
            padding: 17px 5px 17px 35px;
            line-height: 20px;
            width: 25%;
            vertical-align: top;
        }

        .reports-info td .icon {
            float: left;
            margin-left: -33px;
            height: 24px;
            max-width: 24px;
            margin-top: 1px;
            font-size: 25px;
            color: #c9cbd2;
        }

        .reports-info td p {
            color: #7b8397;
            margin: 0;
            font-size: 14px;
            font-weight: 400;
        }

        .reports-info td h6 {
            color: #5a6480;
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .reports-info td h2 {
            color: #5a6480;
            margin: 0;
            /* font-size: 16px; */
            font-weight: 700;
        }

        .table_heading {
            background: #f5f6f8;
            padding: 10px;
            font-size: 28px;
            font-weight: 700;
            color: #5a6480;
            text-transform: uppercase;
        }

        .doughnutText {
            position: absolute;
            top: 0%;
            left: 50%;
            -ms-transform: translate(-50%, 57%);
            transform: translate(-50%, 57%);
        }

        .doughnutText p {
            font-size: 13px;
            font-weight: 400;
            color: #1f2024;
        }

        .reports-info2 img {
            height: 20px;
        }

        .reports-info2 td {
            line-height: 20px;
            vertical-align: top;
        }

        .reports-info2 td .icon {
            float: left;
            margin-left: 0px;
            height: 24px;
            max-width: 24px;
            margin-left: -33px;
            margin-top: 1px;
            font-size: 25px;
            color: #c9cbd2;
        }

        .reports-info2 td p {
            color: #7b8397;
            margin: 0;
            font-size: 14px;
            font-weight: 400;
        }

        .reports-info2 td h6 {
            color: #5a6480;
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .reports-info2 td h2 {
            color: #5a6480;
            margin: 0;
            /* font-size: 16px; */
            font-weight: 700;
        }

        @media print {
            .page_break {
                page-break-after: always;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"
        integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
</head>

<body class="bg-white">
    @php
    $remaining_revenue = $data['main']->ticket_solds + $data['main']->refunded_tickets;
    $remaining_balance = $remaining_revenue - $data['main']->early_payout;
    @endphp

    <div class="section blog picklist" id="resume_div">
        <div class="container-fluid mt-3 bg-white">
            <div class="row">
                <div class="blog__posts col-md-12">
                    <div class="blog__list mt-5">
                        <div class="row ">
                            <div class="col-sm-10 mx-auto col-centered">
                                {{-- < class="single-talent mb-5" style="font-size: 1.6rem;"> --}}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <img src="{{ asset('images/flt-logo.png') }}" style="width: 25%;">
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                                border="0">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <i class="pe-7s-ticket icon"></i>
                                                            <p>Event Name</p>
                                                            <h2>{{ $data['main']->title }}</h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="pe-7s-date icon"></i>
                                                            <p>Start Date & Time</p>
                                                            <h6>{{ dateToTimezone($data['main']->start_date,
                                                                dateFormat('datetime')) }}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <i class="pe-7s-date icon"></i>
                                                            <p>End Date & Time</p>
                                                            <h6>{{ dateToTimezone($data['main']->end_date,
                                                                dateFormat('datetime')) ?? '0' }}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="pe-7s-cash icon"></i>
                                                            <p>Total Tickets Revenue</p>
                                                            <h6>{{ currency($data['main']->ticket_solds, true, true) }}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <i class="fas fa-hand-holding-usd icon"></i>
                                                            <p>Refunded Amount</p>
                                                            <h6>{{ currency($data['main']->refunded_tickets, true, true)
                                                                }}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fas fa-money-bill icon"
                                                                style="font-size: 22px;"></i>
                                                            <p>Tickets Revenue</p>
                                                            <h6>{{ currency($remaining_revenue, true, true) }}</h6>
                                                        </td>
                                                        <td>
                                                            <i class="fas fa-hand-holding-usd icon"></i>
                                                            {{-- <i class="fas fa-money-bill icon"
                                                                style="font-size: 22px;"></i> --}}
                                                            <p>Early Payouts</p>
                                                            <h6>{{ currency($data['main']->early_payout, true, true) }}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="typcn typcn-ticket icon"></i>
                                                            <p>Total Tickets</p>
                                                            <h6>{{ $data['main']->total_tickets_count }}</h6>
                                                        </td>
                                                        <td>
                                                            <i class="pe-7s-users icon"></i>
                                                            <p>Total Attendees</p>
                                                            {{-- <h6>{{ $data['main']->purchased_tickets_qty_sum ?? '0'
                                                                }}</h6> --}}
                                                            <h6>{{ $data['main']->total_attendees_qty ?? '0' }}</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-check icon"></i>
                                                            <p>Checked In</p>
                                                            <h6>{{ $data['main']->qr_checked_count_count ?? '0' }}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <i class="fa fa-times icon"></i>
                                                            <p>Not-Checked In</p>
                                                            <h6>{{ $data['main']->total_attendees_qty -
                                                                $data['main']->qr_checked_count_count ?? '0' }}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="pe-7s-user icon"></i>
                                                            <p>Guests</p>
                                                            <h6>{{ $data['main']->guests_count ?? '0' }}</h6>
                                                        </td>
                                                        <td>
                                                            <i class="fa fa-check icon"></i>
                                                            <p>Guests Checked In</p>
                                                            <h6>{{ $data['main']->checked_in_guests ?? '0' }}</h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-times icon"></i>
                                                            <p>Guests Not-Checked In</p>
                                                            <h6>{{ $data['main']->guests_count -
                                                                $data['main']->checked_in_guests ?? '0' }}</h6>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <canvas id="ticketsDoughnut" width="600" height="600"
                                                style="display: block;"></canvas>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col my-2">
                                            <div class="d-flex flex-column p-3 bg-white shadow rounded h-100">
                                                <div
                                                    class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                                                    Total Visits
                                                </div>
                                                <div class="d-flex align-items-center text-size-3 icon_box mx-auto"
                                                    style="min-height: 9px;margin: 2px 0">
                                                    <i class="pe-7s-graph3 icon mr-2" style="font-size: 38px"></i>
                                                    <div class="text-monospace">
                                                        <span class="text-size-2 card_content">{{
                                                            $data['main']->all_visits_count ?? 0 }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col my-2">
                                            <div class="d-flex flex-column p-3 bg-white shadow rounded h-100">
                                                <div
                                                    class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                                                    Total Sales
                                                </div>
                                                <div class="d-flex align-items-center text-size-3 icon_box mx-auto"
                                                    style="min-height: 9px;margin: 2px 0">
                                                    <i class="pe-7s-graph3 icon mr-2" style="font-size: 38px"></i>
                                                    <div class="text-monospace">
                                                        <span class="text-size-2 card_content">{{
                                                            $data['main']->purchased_tickets_qty_sum ?? '0' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col my-2">
                                            <div class="d-flex flex-column p-3 bg-white shadow rounded h-100">
                                                <div
                                                    class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                                                    Likes
                                                </div>
                                                <div class="d-flex align-items-center text-size-3 icon_box mx-auto"
                                                    style="min-height: 9px;margin: 2px 0">
                                                    <i class="pe-7s-like2 icon mr-2" style="font-size: 38px"></i>
                                                    <div class="text-monospace">
                                                        <span class="text-size-2 ">{{ $data['main']->likes_count
                                                            }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col my-2">
                                            <div class="d-flex flex-column p-3 bg-white shadow rounded h-100">
                                                <div
                                                    class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                                                    Favourites</div>
                                                <div class="d-flex align-items-center text-size-3 icon_box mx-auto"
                                                    style="min-height: 9px;margin: 2px 0">
                                                    <i class="pe-7s-like icon mr-2" style="font-size: 38px"></i>
                                                    <div class="text-monospace">
                                                        <span class="text-size-2 ">{{ $data['main']->fav_count }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col my-2">
                                            <div class="d-flex flex-column p-3 bg-white shadow rounded h-100">
                                                <div
                                                    class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                                                    Shared</div>
                                                <div class="d-flex align-items-center text-size-3 icon_box mx-auto"
                                                    style="min-height: 9px;margin: 2px 0">
                                                    <i class="pe-7s-share icon mr-2" style="font-size: 38px"></i>
                                                    <div class="text-monospace">
                                                        <span class="text-size-2 ">{{ $data['main']->shared ?
                                                            $data['main']->shared->value : 0 }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col my-2">
                                            <div class="d-flex flex-column p-3 bg-white shadow rounded h-100">
                                                <div
                                                    class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">
                                                    Followers</div>
                                                <div class="d-flex align-items-center text-size-3 icon_box mx-auto"
                                                    style="min-height: 9px;margin: 2px 0">
                                                    <i class="pe-7s-users icon mr-2" style="font-size: 38px"></i>
                                                    <div class="text-monospace">
                                                        <span class="text-size-2 ">{{
                                                            $data['main']->user->followers->count() ?? 0 }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page_break">
                                        @include('backend.admin.event.components.bar_map_views')
                                    </div>
                                    @foreach ($data['tickets'] as $ticket_type_title => $ticket_types)
                                    @if ($ticket_types->count() > 0)
                                    @include('backend.admin.report.ticket_table')
                                    @endif
                                    @endforeach
                                    @foreach ($data['tickets_physical'] as $ticket_type_title => $ticket_types)
                                    @if ($ticket_types->count() > 0)
                                    @include('backend.admin.report.ticket_table')
                                    @endif
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"
        integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"
        integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg=="
        crossorigin="anonymous"></script>
    <script>
        //  Doughnut Chart Start here
        var ch_labels = {!! $ticket_name !!};
        var ctx = document.getElementById('ticketsDoughnut');
        var ticketsDoughnut = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ch_labels,
                datasets: [{
                    data: {!! $quantity !!},
                    backgroundColor: [
                        'rgb(252, 171, 170)',
                        'rgb(119, 161, 221)',
                        'rgb(102, 227, 223)',
                        'rgb(254, 199, 101)',
                        'rgb(254, 162, 101)'
                    ],
                    // backgroundColor: [
                    //     'rgb(255, 99, 132)',
                    //     'rgb(54, 162, 235)',
                    //     'rgb(255, 205, 86)'
                    // ],
                    //         borderColor: [
                    // //             'rgba(255, 99, 132, 1)',
                    // // 'rgba(54, 162, 235, 1)',
                    // // 'rgba(255, 206, 86, 1)',
                    // // 'rgba(75, 192, 192, 1)',
                    // // 'rgba(153, 102, 255, 1)',
                    // // 'rgba(255, 159, 64, 1)'
                    //         ],
                    borderWidth: 1
                }]
            },
            // Doughnut chart width

            options: {
                // plugins: {
                //         legend: {
                //             position: 'bottom',
                //         }
                //     },
                // width
                responsive: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            },

        });
        //  Doughnut Chart End here

        // Doughnut Table Chart Start here
        @foreach ($data['tickets'] as $ticket_type_title => $ticket_types)
            @foreach ($ticket_types as $ticket)
                @php
                    if ($ticket->quantity != 0 && $ticket->quantity != null) {
                        $per = ($ticket->total_sold_quantity / $ticket->quantity) * 100;
                    } else {
                        $per = 0;
                    }
                @endphp
                var ctx{{ $ticket->id }} = document.getElementById('tableChart{{ $ticket->id }}');
                var tableDoughnut{{ $ticket->id }} = new Chart(ctx{{ $ticket->id }}, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [
                                '{{ $per }}', '{{ 100 - $per }}'
                            ],
                            backgroundColor: [
                                'rgb(253, 173, 0)',
                                'rgb(230, 230, 230)'
                            ],
                            borderWidth: 0.5,
                        }]
                    },
                    options: {
                        cutout: 25,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                                labels: {
                                    color: 'rgb(255, 99, 132)'
                                }
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                });
            @endforeach
        @endforeach

        // @foreach ($data['tickets_physical']['physical'] as $ticket)
        //     @php
        //         if ($ticket->quantity != 0 && $ticket->quantity != null) {
        //             $per = ($ticket->total_sold_quantity / $ticket->quantity) * 100;
        //         } else {
        //             $per = 0;
        //         }
        //     @endphp
        //     var ctx{{ $ticket->id }} = document.getElementById('tableChart{{ $ticket->id }}_physical');
        //     var tableDoughnut{{ $ticket->id }} = new Chart(ctx{{ $ticket->id }}, {
        //         type: 'doughnut',
        //         data: {
        //             datasets: [{
        //                 data: [
        //                     '{{ $per }}', '{{ 100 - $per }}'
        //                 ],
        //                 backgroundColor: [
        //                     'rgb(253, 173, 0)',
        //                     'rgb(230, 230, 230)'
        //                 ],
        //                 borderWidth: 0.5,
        //             }]
        //         },
        //         options: {
        //             cutout: 25,
        //             maintainAspectRatio: false,
        //             plugins: {
        //                 legend: {
        //                     display: false,
        //                     labels: {
        //                         color: 'rgb(255, 99, 132)'
        //                     }
        //                 }
        //             },
        //             scales: {
        //                 yAxes: [{
        //                     ticks: {
        //                         beginAtZero: true
        //                     }
        //                 }]
        //             }
        //         },
        //     });
        // @endforeach

        //  Doughnut Chart End here

        jQuery(document).ready(function() {
            setTimeout(function() {
                window.print();
            }, 500);
        });
    </script>
</body>

</html>