@extends('backend.layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
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

    .codeblock{
        background: black;
        color: white;
        height: 67px !important;
    }

    .codeblock:focus {
        color: white !important ;
        background-color: black !important;
    }

    .custom-select>.btn.focus, .custom-select>.btn:focus,.custom-select>.bootstrap-select .dropdown-toggle:focus {
        outline: unset !important;
        box-shadow: unset !important;
    }

    select.bs-select-hidden, .bootstrap-select > select.bs-select-hidden, select.selectpicker {
        display: block !important;
    }
    .dropdown .dropdown-toggle:after {
        content: none !important;
    }
</style>
@endsection

@section('content')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Sites</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="{{route('backend.job.index')}}" class="breadcrumb-item"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Home</a>
                    <span class="breadcrumb-item active">Sites</span>
                </nav>
            </div>
        </div>

        <div class="card p-r-15 p-l-15">
            <div class="row align-items-md-center">
                <div class="col-md-6">
                    <div class="media m-v-10">
                        <div class="avatar avatar-cyan avatar-icon avatar-square">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="media-body m-{{$alignShortRev}}-15">
                            <h6 class="mb-0">All Sites</h6>
                            {{-- <span class="text-gray font-size-13">Sanad Team</span> --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="text-md-{{$alignreverse}} m-v-10">
                        @if (hasPermission('Add Data'))
                            <a href="javascript:void(0)" class="btn btn-primary m-{{$alignShortRev}}-15">
                                <span>Add new Job</span>
                            </a>
                        @endif
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <!-- Card View -->
                <div class="row" id="list-view">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
											<tr>
                                                <th>#</th>
                                                <th>Site Name</th>
                                                <th>Total jobs</th>
                                                <th>Total Clicks</th>
                                                <th>Total Views</th>
                                                <th>Action</th>
											</tr>
										</thead>
										<tbody>
                                            @php
                                                $count=0;
                                            @endphp
											@forelse($sites as $key => $site)
                                                <tr>
                                                    <td>{{++$count}}</td>
                                                    <td class="name-badge p-3 w-20">{{ $key ?? '' }}</td>
                                                    <td>{{ $site->count() ?? '' }}</td>
                                                    <td>{{ $site->sum('clicks') ?? '' }}</td>
                                                    <td>{{ $site->sum('views') ?? '' }}</td>
                                                    <td>
                                                        <a href="{{route('backend.job.index')}}?jobs={{implode('|',$site->pluck('job_id')->toArray())}}" class="btn btn-primary">View Jobs</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No Sites found</td>
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
		
        /* $('.search__').on('click', function(){
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
        }) */

        @if(session()->has('budget_error'))
            $('.edit_budget[data-job-id='+{{session()->get('budget_error')}}+']').trigger('click');
        @endif
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
                    
                    @if(session()->has('budget_error'))
                        var errorString = '<ul class="p-4 text-white">';
                        @foreach ($errors->all() as $error)
                            errorString += '<li>' + "{{$error}}" + '</li>';
                        @endforeach
                        errorString += '</ul>';

                        $('#budget_valid_errors').html(errorString);$
                    @endif

                    $('#jobModal').modal('toggle');
                }
                else if(res.status=='error') {
                    toastr.success(res.message)
                }
            }
        });
        
    });

    $(document).on('click','.job_pixel',function(e){
        e.preventDefault();
        // fullPageLoader(true);
        var cat_id=$(this).data('job-id');

        $.ajax({
            url: "{{ url('/') }}/backend/job_update/"+cat_id+"?type=pixel",
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


<script src="{{asset('js/repeater.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    
    function setSelectPicker()
    {
        $('.selectpicker').selectpicker();
        $('.selectpicker').siblings('.dropdown-toggle').removeClass('btn-light');
    }
    
</script>

@endsection