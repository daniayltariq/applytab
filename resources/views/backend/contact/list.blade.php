@extends('backend.layouts.app')

@section('styles')
<link href="{{asset('backend-assets/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.5/sweetalert2.css" integrity="sha512-WfDqlW1EF2lMNxzzSID+Tp1TTEHeZ2DK+IHFzbbCHqLJGf2RyIjNFgQCRNuIa8tzHka19sUJYBO+qyvX8YBYEg==" crossorigin="anonymous" />
	<style>
		.bootstrap-switch-container{
			width: 160px !important;
		}

		.name-badge{
			position: relative;
    		min-width: 175px;
			font-size: 13px;
		}
		.btn-primary{
			color: #5d78ff;
		}

		.pagination {
			display: inline-block;
			padding-left: 0;
			margin: 20px 0;
			border-radius: 4px;
		}

		.pagination>li {
			display: inline;
		}

		.blog__pagination {
			margin: 0;
			text-align: center;
		}

		.blog__pagination .pagination {
			padding: 60px 0 0;
			margin: 0;
			border-top: 1px solid #ddd;
		}

		.pagination>li:last-child>a, .pagination>li:last-child>span, .pagination>li:first-child>a, .pagination>li:first-child>span, .pagination>li>a, .pagination>li>span {
			border-radius: 0;
		}

		.pagination>li>a, .pagination>li>span {
			position: relative;
			float: left;
			padding: 6px 12px;
			margin-left: -1px;
			line-height: 1.42857143;
			color: #337ab7;
			text-decoration: none;
			background-color: #fff;
			border: 1px solid #ddd;
		}
		.pagination>li>a, .pagination>li>span {
			border: none;
			color: #3a3a54;
			font-weight: 600;
			text-transform: uppercase;
			background: #F6F6F6;
			margin-left: 17px;
			font-size: 15px;
			padding: 8px 16px;
		}


		.new-picklist{
			display: none;
		}

		.error{
			color: red;
		}

		.btn-bg-white{
			background: #fff !important;
		}

		.btn-primary{
			color: #5d78ff;
		}

		.blue-btn:hover,
   .blue-btn:active,
   .blue-btn:focus,
   .blue-btn {
      background: transparent;
      border: solid 1px #27a9e0;
      border-radius: 3px;
      color: #27a9e0;
      font-size: 16px;
      margin-bottom: 20px;
      outline: none !important;
      padding: 10px 20px;
   }

   .fileUpload {
      position: relative;
      overflow: hidden;
      height: 43px;
      margin-top: 0;
   }

   .fileUpload input.contact__upload {
      position: absolute;
      top: 0;
      right: 0;
      margin: 0;
      padding: 0;
      font-size: 20px;
      cursor: pointer;
      opacity: 0;
      filter: alpha(opacity=0);
      width: 100%;
      height: 42px;
   }

   /*Chrome fix*/
   input::-webkit-file-upload-button {
      cursor: pointer !important;
      height: 42px;
      width: 100%;
   }

   .w-70{
      width: 70%;
   }
   img.img.img-thumbnail {
       max-width: 100px;
   }

   .justify_center{
	justify-content: center;
   }

   .btn-success {
		background-color: #0abb87 !important;
	}
	</style>
@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--begin::Portlet-->
	<div class="kt-portlet">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title">
					Customer Contacts
				</h3>
				
			</div>
			<div class="kt-portlet__head-label" style="float: right">
				<button type="button" class="btn btn-info btn-xs mr-3" id="contact_upload_btn"><i class='fa fa-plus'></i> Upload Contacts</button>
				{{-- <a href="{{route('backend.customer-contact.validate')}}" class="btn btn-success btn-xs mr-3"> Validate Data</a> --}}
				{{-- <form action="{{route('backend.customer-contact.search')}}" method="GET">
					<div class="form-group mb-0">
					<div class="input-group">
						<input type="text" class="form-control" name="search_text" placeholder="Search for...">
						<div class="input-group-append">
							<button class="btn btn-secondary" type="submit">Go!</button>
						</div>
					</div>
				</div>
				</form> --}}
				
			</div>
		</div>
		<div class="kt-portlet__body">
			<!--begin::Section-->
			<div class="kt-section">
				 
				<div class="kt-section__content">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
								   <th>Name</th>
								   <th>Social Security no</th>
								   <th>Gender</th>
								   <th>Address</th>
								   <th>Post Number</th>
								   <th>City</th>
								   <th>Tel 0</th>
								   <th>Tel 1</th>
								   <th>Tel 2</th>
								   <th>Tel 3</th>
								   <th>Tel 4</th>
								   <th>Tel 5</th>
								   <th>Tel 6</th>
								   <th>Tel 7</th>
								   <th>Tel 8</th>
								   <th>Tel 9</th>
								   <th>Web 2</th>
								   <th>Condominiums</th>
								</tr>
							</thead>
							<tbody>
								@foreach($contacts as $key => $contact)
									<tr>
										<td>{{++$key}}</td>
										<td class="name-badge p-3">{{ $contact->name ?? '' }}</td>
										<td>{{ $contact->dob_and_social_security_no ?? '' }}</td>
										<td>{{ $contact->gender ?? '' }}</td>
										<td>{{ $contact->address ?? '' }}</td>
										<td>{{ $contact->post_number ?? '' }}</td>
										<td>{{ $contact->city ?? '' }}</td>
										<td>{{ $contact->tel0 ?? '' }}</td>
										<td>{{ $contact->tel1 ?? '' }}</td>
										<td>{{ $contact->tel2 ?? '' }}</td>
										<td>{{ $contact->tel3 ?? '' }}</td>
										<td>{{ $contact->tel4 ?? '' }}</td>
										<td>{{ $contact->tel5 ?? '' }}</td>
										<td>{{ $contact->tel6 ?? '' }}</td>
										<td>{{ $contact->tel7 ?? '' }}</td>
										<td>{{ $contact->tel8 ?? '' }}</td>
										<td>{{ $contact->tel9 ?? '' }}</td>
										<td>{{ $contact->web2 ?? '' }}</td>
										<td>{{ $contact->condominiums ?? '' }}</td>
										{{-- <td>
											
											<div class="dropdown dropdown-inline">
												<button type="button" class="btn btn-default btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="flaticon-more"></i>
												</button>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="{{route('backend.user.edit',$user->id)}}" ><i class="fas fa-pencil-alt"></i>Edit</a>
													<a class="dropdown-item" href="{{route('backend.user.impersonate',$user->id)}}" ><i class="fa fa-user"></i>impersonate</a>
												</div>
											</div>
											
										</td> --}}
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<nav class="blog__pagination">
				@if ($contacts->lastPage() > 1)
				 <ul class="pagination">
					 <li class="{{ ($contacts->currentPage() == 1) ? ' disabled' : '' }}">
						 <a href="{{ $contacts->url(1) }}">First</a>
					  </li>
					 @for ($i = 1; $i <= $contacts->lastPage(); $i++)
						 <?php
						 $half_total_links = floor(5 / 2);
						 $from = $contacts->currentPage() - $half_total_links;
						 $to = $contacts->currentPage() + $half_total_links;
						 if ($contacts->currentPage() < $half_total_links) {
							$to += $half_total_links - $contacts->currentPage();
						 }
						 if ($contacts->lastPage() - $contacts->currentPage() < $half_total_links) {
							 $from -= $half_total_links - ($contacts->lastPage() - $contacts->currentPage()) - 1;
						 }
						 ?>
						 @if ($from < $i && $i < $to)
							 <li class="{{ ($contacts->currentPage() == $i) ? ' active' : '' }}">
								 <a href="{{ $contacts->url($i) }}">{{ $i }}</a>
							 </li>
						 @endif
					 @endfor
					 <li class="{{ ($contacts->currentPage() == $contacts->lastPage()) ? ' disabled' : '' }}">
						 <a href="{{ $contacts->url($contacts->lastPage()) }}">Last</a>
					 </li>
				 </ul>
			 @endif
			 </nav>
			<!--end::Section-->
		</div>
		<!--end::Form-->
	</div>
	<!--end::Portlet-->
</div>

<div class="modal fade" id="contact_upload" tabindex="-1" role="dialog" aria-labelledby="contact_uploadLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		 
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<form action="{{route('backend.customer-contact.store')}}" method="POST" enctype="multipart/form-data" >
		  @csrf
		  <div class="modal-body">
				<div class="row justify_center">
					  @if ($errors->any())
						 <ul id="errors" style="color: red;width: 60%;">
							@foreach ($errors->all() as $error)
							   <li>{{ $error }}</li>
							@endforeach
						 </ul>
					  @endif
					  @if (session('validation_errors') && count(session('validation_errors')) > 0)
						 <ul id="errors" style="color: red;width: 60%;">
							@foreach (session('validation_errors') as $error)
							   <li>{{ $error }}</li>
							@endforeach
						 </ul>
					  @endif

					{{-- @if(session()->has('upload_success') )
						 <div class="col-md-12">
							<div class="alert alert-outline-success fade show" role="alert">
								<div class="alert-icon"><i class="flaticon-warning"></i></div>
								<div class="alert-text">Data has been uploaded successfully,you can validate the data now. <br><a href="{{route('backend.customer-contact.validate')}}" class="btn btn-success text-white">Purify Data</a></div>
								
							</div>
						 </div>
					@else --}}
						<div class="fileUpload blue-btn btn w-70">
							<span>Upload Customer Data</span>
							<input type="file" class="contact__upload" name="contact_data"/>
						</div>
					{{-- @endif --}}
				</div>
		  </div>
		  <div class="modal-footer">
				@if(! session()->has('upload_success') )
			 		<button type="submit" class="btn btn-primary text-white">Upload</button>
				@endif
		  </div>
	   </form>
	  </div>
	</div>
</div>

@endsection

@section('scripts')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.js" data-turbolinks-track="true"></script>
<script type="text/javascript">

// $("input[type=file]").change(function(){
// 	changeImageView(this);
// });

$(document).ready(function(){

	$('#contact_upload_btn').on('click',function(){
		$('#contact_upload').modal('toggle');
	});

	$("[name='status']").bootstrapSwitch();

	$("[name='status']").on('switchChange.bootstrapSwitch',function (e, state) {
		/* console.log($(this).data('userid')); */
		const that=this;
		$.get("{{ route('backend.user.updateStatus') }}",
		{
			user_id: $(this).data('userid'),
			status:state==true?1 : 0
		},
		function(status){
			
			if (status=="success") {
				$(that).bootstrapSwitch('state', state, true);
			} else {
				$(that).bootstrapSwitch('state', !state, true);
			}
		});
		
	});

	@if($errors->has('contact_data') )
		$('#contact_upload').modal('show');
	@endif

	/* @if(session()->has('upload_success') )
		$('#contact_upload').modal('show');
	@endif */
	
});
</script>

<script>
	
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.5/sweetalert2.min.js" integrity="sha512-+uGHdpCaEymD6EqvUR4H/PBuwqm3JTZmRh3gT0Lq52VGDAlywdXPBEiLiZUg6D1ViLonuNSUFdbL2tH9djAP8g==" crossorigin="anonymous"></script>
<script>
	$('.del_pl').on('click',function(e){
		var that=$(this);
		e.preventDefault();
		
		
		Swal.fire({
			title: 'Are you sure?',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
			}).then((result) => {
			if (result.isConfirmed) {
				
				that.parent('form').submit();
			}
		})
	})
</script>
@endsection