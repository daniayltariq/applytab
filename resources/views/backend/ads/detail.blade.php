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
                    <a href="{{route('backend.adsListing')}}" class="breadcrumb-item"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Ad</a>
                    <span class="breadcrumb-item active">Ad Statistics</span>
                </nav>
            </div>
        </div>

        <div class="card p-r-15 p-l-15">
            <div class="row align-items-md-center">
                <div class="col-md-6">
                    <div class="media m-v-10">
                        <div class="avatar avatar-cyan avatar-icon avatar-square">
                            <i class="fa fa-file"></i>
                        </div>
                        <div class="media-body m-{{$alignShortRev}}-15">
                            <h5 class="mb-0"><b>Ad Report</b></h5>
                            {{-- <span class="text-gray font-size-13">{{$ad->ad_url ?? ''}}</span> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="text-md-{{$alignreverse}} m-v-10">
                        <a href="{{route('backend.job.report',$job->id)}}" class="btn btn-primary m-{{$alignShortRev}}-15">
                            <span>Report</span>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="row align-items-md-center">
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                            <img width="185px" src="{{ $ad->image }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row align-items-md-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="media m-v-10">
                                    <div class="avatar avatar-cyan avatar-icon avatar-square">
                                        <i class="fa fa-dollar-sign"></i>
                                    </div>
                                    @php
                                        $clicks=isset($stats['clicks']) ? $stats['clicks'] : 0;
                                        $cost=$clicks ? number_format(($ad->cost_per_click/$clicks),2, '.', '') : 0;
                                    @endphp
                                    <div class="media-body m-{{$alignShortRev}}-15">
                                        <h5 class="mb-2">
                                            <b>Cost per Click</b></h5>
                                            <span class="text-dark font-size-18">${{$cost}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media m-v-10">
                                    <div class="media-body">
                                        <h5 class=""><b> Expires at: </b>{{date__format($ad->ad_expiry)}}</h5> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media m-v-10">
                                    <div class="media-body"> <h5 class=""><b> Quota: </b>{{isset($stats['views']) ? $stats['views'] : 0}}/{{$ad->ad_limit}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="media m-v-10">
                    <div class="media-body">
                        <span class=""><b> Quota: </b>{{$ad->ad_limit}}</span>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center">
                            <p class="m-b-0 text-muted">Clicks</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="fas fa-bullseye stats-icon"></i>
                                <h2 class="m-b-0 stats-val">{{isset($stats['clicks']) ? $stats['clicks'] : 0}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center">
                            <p class="m-b-0 text-muted">Impressions</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="fas fa-eye stats-icon"></i>
                                <h2 class="m-b-0 stats-val">{{isset($stats['views']) ? $stats['views'] : 0}}</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-between align-items-center">
                            <p class="m-b-0 text-muted">Job Board</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <i class="fas fa-regular fa-building stats-icon"></i>
                                <h2 class="m-b-0 stats-val">{{$ad->adSites->count() ?? ''}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Card View -->
                <div class="row" id="list-view">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Job Board</th>
                                            <th scope="col">Impressions</th>
                                            <th scope="col">Clicks</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($statdetails as $key => $statdetail)
                                                <tr>
                                                    <th scope="row">{{++$key}}</th>
                                                    <td>{{$statdetail['site']}}</td>
                                                    <td>{{$statdetail['views']}}</td>
                                                    <td>{{$statdetail['clicks']}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="detail-bold">Total Clicks on all sites:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="detail">{{isset($statdetails['click']) ? $statdetails['click']->count() : 0}}</span>
                                    </div>
                                </div>
                                @if (isset($statdetails['click']))
                                    @foreach ($statdetails['click'] as $statdetail)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <span class="detail-bold">{{$statdetail->source}}</span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="detail">Clicks :</span>
                                                </div>
                                                <div class="col-md-6">
                                                    {{$statdetail->clicks}}
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div id="filterSidenav" class="sidenav">
		
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<form class="container" method="GET">
            <input type="hidden" name="search_text" value="{{request()->query('search_text')}}">
			<div class="row mt-3">
				<div class="col-md-12 mb-2">
					<h4><i class="fa fa-filter"></i> Filter:</h4>
				</div>
				<div class="form-group col-md-12">
                    @php
                        $user_type = request()->query('type') ? request()->query('type') :'';
                    @endphp
                    <label class="font-weight-semibold" for="language">Type</label>
                    <select id="country" class="form-control" name="type" required>
                        <option value="" selected>select...</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    @php
                        $product_category = request()->query('product_category') ? request()->query('product_category') :'';
                    @endphp
                    <label class="font-weight-semibold" for="fullAddress">Category:</label>
                    <select class="form-control" name="product_category">
                        <option value="" selected>Select...</option>
                    </select>
                    
                </div>
                <div class="form-group col-md-12">
                    
                    <label class="font-weight-semibold" for="language">Start date</label>
                    <input type="date" name="start_date" id="" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    
                    <label class="font-weight-semibold" for="fullAddress">End Date:</label>
                    <input type="date" name="end_date" id="" class="form-control">
                    
                </div>
				<div class="col-md-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
				</div>
			</div>

		</form>
	</div>


    <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg job_modal_div" role="document">
            
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.23/daterangepicker.min.js"></script>
<script type="text/javascript">
	
	$(document).ready(function(){
		/* $("[name='status']").bootstrapSwitch(); */

		/* @if(request()->query() && !request()->query('type'))
            openNav();
		@endif */
		
        $('.search__').on('click', function(){
            var search = new URLSearchParams(location.search);
            if (search.has("search_text")) {
                search.set("search_text", $('#search_text').val());
                var newSearch = search.toString();
                window.history.pushState({}, "", `${location.pathname}?${newSearch}`);
            }else{
                var $url=$(this).closest('form').attr('action');
                window.location.href= $url+'&search_text='+$('#search_text').val();
                return ;
            }
            
            window.location.reload();
        })
	});

    $(document).on('click','.edit_url',function(e){
        e.preventDefault();
        // fullPageLoader(true);
        var cat_id=$(this).data('job-id');

        $.ajax({
            url: "{{ url('/') }}/backend/job_update/"+cat_id+"?type=url",
            type: 'GET',
            success: function (res) {
                // fullPageLoader(false);
                if (res.status=='success') {
                    $(' .job_modal_div').html(res.data);
                    $('#jobModal').modal('toggle');
                }
                else if(res.status=='error') {
                    toastr.success(res.message)
                }
            }
        });
        
    });

    $(document).on('click','.edit_budget',function(e){
        e.preventDefault();
        // fullPageLoader(true);
        var cat_id=$(this).data('job-id');

        $.ajax({
            url: "{{ url('/') }}/backend/job_update/"+cat_id+"?type=budget",
            type: 'GET',
            success: function (res) {
                // fullPageLoader(false);
                if (res.status=='success') {
                    $(' .job_modal_div').html(res.data);
                    $('#jobModal').modal('toggle');
                }
                else if(res.status=='error') {
                    toastr.success(res.message)
                }
            }
        });
        
    });

    function openNav() {
        document.getElementById("filterSidenav").style.width = "400px";
        if($('.bulkupdate').is(':checked')){
            $('#startdatediv').css('display','none');
        }else{
            $('#startdatediv').css('display','block');
        }
    }

    function closeNav() {
        document.getElementById("filterSidenav").style.width = "0";
	}
</script>

<script>
	
</script>

@endsection