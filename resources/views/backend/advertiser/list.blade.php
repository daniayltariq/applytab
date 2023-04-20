@extends('backend.layouts.app')

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<link href="{{asset('backend/assets/vendors/bootstrap4-toggle/css/bootstrap4-toggle.min.css')}}" rel="stylesheet">
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

    .toggle.btn-primary{
        background-color: #fcb41a;
        border-color: #fcb41a;
    }

    .toggle-on, .toggle-on:hover{
        background-color: #fcb41a;
        border-color: #fcb41a; 
    }
</style>
@endsection

@section('content')

    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">Advertisers</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash d-flex">
                    <a href="{{route('backend.advertiser.index')}}" class="breadcrumb-item my-auto"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Advertisers Directory</a>
                </nav>
            </div>
        </div>

        <div class="card p-r-15 p-l-15">
            <div class="row align-items-md-center">
                <div class="col-md-6">
                    <div class="media m-v-10  d-flex ">
                        <div class="avatar avatar-cyan avatar-icon avatar-square">
                            <i class="fas fa-ad"></i>
                        </div>
                        <div class="media-body my-auto m-{{$alignShortRev}}-15">
                            <h6 class="mb-0">All Advertisers</h6>
                            {{-- <span class="text-gray font-size-13">Sanad Team</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="form-row" action="{{ getFullUrl() }}">
                    <h3 class="col-md-12">Search Advertisers</h3>
                    <hr>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="search" name="search" value="{{request()->query('search')}}">
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-primary" type="submit">Go</button>
                    </div>
                </form>
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
                                                <th>Advertiser</th>
                                                <th>Type</th>
                                                <th>Acronym</th>
                                                <th>Action</th>
											</tr>
										</thead>
										<tbody>
											@forelse($advertisers as $key => $item)
                                                <tr>
                                                    <td>{{$item->inst_name}}</td>
                                                    <td>{{$item->type->inst_type_name ?? ''}}</td>
                                                    <td>{{$item->acronym ?? '-'}}</td>
                                                    <td width="350px">
                                                        <a href="{{route('backend.adCreate',['institute' => $item->id])}}" class="btn btn-success btn-sm">Ad</a>
                                                        <a href="{{route('backend.advertiser.edit',$item->id)}}" class="btn btn-primary btn-sm btn_y">Edit</a>
                                                        <form method="POST" action="{{ route('backend.advertiser.delete', $item->id) }}" style="display: inline-block;">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button title="Delete record" type="submit" class="btn btn-danger btn-sm btn_r" data-toggle="confirmation">Delete</button>
                                                        </form>
                                                        
                                                        <a href="{{route('backend.advertiser.show',$item->id)}}" class="btn btn-warning btn-sm">Report</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No Advertisers found!</td>
                                                </tr>
                                            @endforelse
										</tbody>
                                    </table>
                                </div>
                                {!!$advertisers->appends($_GET)->links()!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-confirmation2@4.1.0/dist/bootstrap-confirmation.min.js"></script>
<script src="{{asset('backend/assets/vendors/bootstrap4-toggle/js/bootstrap4-toggle.min.js')}}"></script>
<script type="text/javascript">
    $('[data-toggle=confirmation]').confirmation({
      rootSelector: '[data-toggle=confirmation]',
      // other options
    });

</script>

@endsection
