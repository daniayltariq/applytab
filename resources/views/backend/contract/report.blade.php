@extends('backend.layouts.app')

@section('styles')
<style>
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
        top: 38;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
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
        #printToPDF {
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    .logo-report{
        font-size: 4rem;
    }

    .bg__border{
        background: #ececec;
        border-bottom: 2px solid grey;
    }

    .b_bottom_light{
        border-bottom: 2px solid rgb(199, 199, 199);
    }

    .tags span{
        font-size: 13px;
        margin: 4px 0px;
        white-space: nowrap;
    }

    .p-rel{
        position: relative;
    }

    .p-rel img{
        position: absolute;
        top: 20px;
        left: 5px;
        opacity: 0.6;
    }
</style>
@endsection

@section('content')
<div class="main-content">
    {{-- <div class="section mt-4">
        <div class="container p-0">
            <a href="{{route('backend.contract.print', $contract->id)}}" target="_blank" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Print</a>
        </div>
    </div> --}}
    <div class="section blog picklist mb-5" id="resume_div">
        <div class="card mt-3 bg-white pb-5">
            <div class="row">
                <div class="blog__posts col-md-12">
                    <div class="blog__list mt-5">
                        <div class="row" id="printToPDF">
                            <div class="col-sm-10 mx-auto col-centered">
                                {{-- < class="single-talent mb-5" style="font-size: 1.6rem;"> --}}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        {{-- <img src="{{ asset('images/flt-logo.png') }}" style="width: 25%;"> --}}
                                        <h1 class="logo-report"><b class="text-color1">Cont</b><b class="text-color2"> Man</b></h1>
                                    </div>
                                </div>
                                <div id="collapseDoughnutChart" class="row collapse show">
                                    <div class="col-md-6">
                                        <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                            border="0">
                                            <tbody>
                                                <tr class="bg__border">
                                                    <td class="pt-0 pb-2 pl-1" colspan="2">
                                                        <h3 class="mb-0">Contract Info</h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pt-5" colspan="2">
                                                        <i class="pe-7s-ticket icon fa fa-tag"></i>
                                                        <p>Contract Type</p>
                                                        <h2>{{$contract->user_type }}</h2>
                                                    </td>
                                                </tr>
                                                @if ($contract->user_type=='vendor')
                                                    <tr>
                                                        <td>
                                                            <i class="pe-7s-date icon fa fa-user"></i>
                                                            <p>Vendor</p>
                                                            <h6>{{ $contract->user->name ?? ''}}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <i class="pe-7s-date icon fa fa-user"></i>
                                                            <p>Purchaser</p>
                                                            <h6>{{ $contract->association->name ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            <i class="pe-7s-date icon fa fa-user"></i>
                                                            <p>Customer</p>
                                                            <h6>{{ $contract->user->name ?? ''}}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <i class="pe-7s-date icon fa fa-user"></i>
                                                            <p>Salesperson</p>
                                                            <h6>{{ $contract->association->name ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                @endif
                                                
                                                <tr>
                                                    <td>
                                                        <i class="pe-7s-date icon fa fa-calendar"></i>
                                                        <p>Start Date</p>
                                                        <h6>{{ $contract->start_date ?? ''}}
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <i class="pe-7s-date icon fa fa-calendar"></i>
                                                        <p>End Date</p>
                                                        <h6>{{ $contract->end_date ?? ''}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="pe-7s-date icon fa fa-calendar"></i>
                                                        <p>Renewal Date</p>
                                                        <h6>{{ $contract->renewal_date ?? ''}}
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <i class="pe-7s-date icon fa fa-calendar"></i>
                                                        <p>Renewal Reminder Date</p>
                                                        <h6>{{ $contract->renewal_reminder_date ?? ''}}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-rel">
                                                        <img src="{{asset('backend/assets/images/kr.png')}}" alt="">
                                                        {{-- <i class="fa fa-dollar-sign icon"></i> --}}
                                                        <p>Contract value</p>
                                                        <h6>  {{ $contract->contract_value }}</h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    @if (count($contract->media))
                                        <div class="col-md-6">
                                            <div class="row">
                                                <h4 class="w-100">Contract files
                                                    <span class="float-right">
                                                        @foreach ($contract->media as $key => $media)
                                                            <div class="btn-group mb-2">
                                                                <button class="btn btn-primary btn-sm media_btn" data-mediaID="{{$key+1}}">{{ $media->orig_name }}</button>
                                                                <button type="button" class="btn btn-sm open_external" data-iframesrc="{{$media->file}}"><i class="fas fa-external-link-alt"></i></button>
                                                            </div>
                                                        @endforeach
                                                    </span>
                                                </h4>
                                                @foreach ($contract->media as $key => $media)
                                                    <div class="col-md-12 p-0 media_div" style="display:{{$loop->first ? 'block' : 'none'}}" data-mediaID="{{$key+1}}">
                                                        
                                                        <iframe src="{{ $media->file }}" frameborder="0" style="width:100%; height:550px;"></iframe>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    
                                    
                                </div>
                                @if ($contract->user_type=='customer')
                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <h3 class="pl-1 bg__border">Additional Info</h3>
                                            <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                                border="0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <i class="pe-7s-date icon fa fa-file-contract"></i>
                                                            <p>Contract Type</p>
                                                            <h6>{{ $contract->contract_type ?? ''}}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <i class="pe-7s-date icon fa fa-plug"></i>
                                                            <p>Extension</p>
                                                            <h6>{{ $contract->extension ?? ''}}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <i class="pe-7s-date icon fa fa-calendar"></i>
                                                            <p>Extension Period</p>
                                                            <h6>{{ $contract->extension_period ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <h3 class="b_bottom_light">Performance/ KPI</h3>
                                            <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                                border="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="pl-0">
                                                            <p>Delivery degree</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $contract->performance_delivery_degree ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">
                                                            <p>Delivery time</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $contract->performance_delivery_time ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">
                                                            <p>Quality</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $contract->performance_quality ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="col-md-6 mt-3">
                                            <h3 class="b_bottom_light">Fines elements</h3>
                                            <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                                border="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="pl-0">
                                                            <p>Delivery degree</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $contract->performance_delivery_degree ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">
                                                            <p>Delivery time</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $contract->performance_delivery_time ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">
                                                            <p>Quality</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $contract->performance_quality ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <h3 class="b_bottom_light">Product Category</h3>
                                            <div class="tags pl-1">
                                                @foreach ($contract->product_categories as $cats)
                                                    <span class="badge badge-pill badge-primary">{{ $cats->product_category->category_name ?? ''}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mt-3">
                                            <h3 class="b_bottom_light">Meeting</h3>
                                            <table class="reports-info" width="100%" cellspacing="0" cellpadding="0"
                                                border="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="pl-0">
                                                            <p>Status Meeting</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $contract->status_meeting ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0">
                                                            <p>Meeting Date</p>
                                                        </td>
                                                        <td>
                                                            <h6>{{ $contract->meeting_date ?? ''}}
                                                            </h6>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <h3 class="b_bottom_light">Delivery Instructions / guidelines</h3>
                                            @php
                                                $delivery_instructions=explode(',',$contract->delivery_instructions);
                                            @endphp
                                            <div class="tags pl-1">
                                                @foreach ($delivery_instructions as $inst)
                                                    <span class="badge badge-pill badge-primary">{{ $inst ?? ''}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
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
<script type="text/javascript">
	
	$(document).ready(function(){
		$('.media_btn').on('click', function(){
            var media_id= $(this).attr('data-mediaid');
            $('.media_div').hide();
            $('.media_div[data-mediaid="'+media_id+'"]').show();
        })

        $('.open_external').on('click', function(){
            var win = window.open();
            win.document.write('<iframe style="position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;" src="'+$(this).attr('data-iframesrc')+'" frameborder="0" allowfullscreen></iframe>')
        })
	});

</script>

<script>
	
</script>

@endsection