
@extends('backend.layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<style>

    .select2-container {
        display: block;
    }
    .select2-container-multi .select2-choices {
        min-height: 2.5375rem;
        border: 1px solid #edf2f9;
        background-image: none;
    }

   .checkbox-group {
   display: block;
   }

   .checkbox-group input {
   padding: 0;
   height: initial;
   width: initial;
   margin-bottom: 0;
   display: none;
   cursor: pointer;
   }

   .checkbox-group label {
   position: relative;
   cursor: pointer;
   }

   .checkbox-group label:before {
   content:'';
   -webkit-appearance: none;
   background-color: transparent;
   border: 2px solid #0079bf;
   box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
   padding: 10px;
   display: inline-block;
   position: relative;
   vertical-align: middle;
   cursor: pointer;
   margin-right: 5px;
   }

   .checkbox-group input:checked + label:after {
   content: '';
   display: block;
   position: absolute;
   top: 2px;
   left: 9px;
   width: 6px;
   height: 14px;
   border: solid #0079bf;
   border-width: 0 2px 2px 0;
   transform: rotate(45deg);
   }

   .select2-search:after{
      top: 10px !important;
      font-size: 18px !important;
   }

   .select2-container--default .select2-selection--multiple{
      padding: 0.55rem 1rem !important;
      border: 1px solid #d1d7dd !important;
   }

   .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #e31c79;
    border: 1px solid #e31c79;
    color: white;
   }

   .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
      border-right: white;
      color: white;
   }

    /* upload css */
    .file-block {
        border-radius: 10px;
        background-color: rgba(144, 163, 203, 0.2);
        margin: 5px;
        color: initial;
        display: inline-flex;
    }
    .file-block > span.name {
        padding: 4px;
        width: max-content;
        display: inline-flex;
    }
    .file-delete {
        display: flex;
        width: 34px;
        color: initial;
        background-color: #6eb4ff 0;
        font-size: large;
        justify-content: center;
        cursor: pointer;
    }
    .file-delete:hover {
        background-color: rgba(144, 163, 203, 0.2);
        border-radius: 10px;
    }
    .file-delete > span {
        transform: rotate(45deg);
    }
 
    /* Dropzone */
    .card-upload {
        background-color: #fff;
        width: 500px;
        border-radius: 0.5rem;
        box-shadow: 0px 5px 20px rgba(49, 104, 146, .25);
    }
    .card-upload .card-body {
        padding: 3.5rem 1.25rem;
    }
    .card-upload .card-body .card-title {
        color: #1689ff;
        font-size: 1.25rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 0.25rem;
    }
    .card-upload .card-body .card-subtitle {
        color: #777;
        font-weight: 500;
        text-align: center;
    }
    .file-upload {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 2rem 1.5rem;
        border: 3px dashed #9dceff;
        border-radius: 0.5rem;
        transition: background-color 0.25s ease-out;
    }
    .file-upload:hover {
        background-color: #dbedff;
    }
    .file-upload .file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        outline: none;
        cursor: pointer;
    }
    .icon {
        width: 75px;
        margin-bottom: 1rem;
    }
    @media (max-width: 600px) {
        .icon {
            width: 50px;
        }
    }
 
    .selector{
        position:relative;
        width:34%;
        background-color:var(--smoke-white);
        display:flex;
        justify-content:space-around;
        align-items:center;
        border-radius:9999px;
        border: 2px solid #f2f2f2;
    }
    .selecotr-item{
        position:relative;
        flex-basis: calc(100% / 2);
        height:100%;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .selector-item_radio{
        appearance:none;
        display:none;
    }
    .selector-item_label{
        position:relative;
        height:80%;
        width:100%;
        text-align:center;
        border-radius:9999px;
        line-height:400%;
        font-weight:900;
        transition-duration:.5s;
        transition-property:transform, color, box-shadow;
        transform:none;
        margin-bottom: 0;
    }
    .selector-item_radio:checked + .selector-item_label{
        background-color:#e31c79;
        color:var(--white);
        /* box-shadow:0 0 4px rgba(0,0,0,.5),0 2px 4px rgba(0,0,0,.5); */
        transform:translateY(-2px);
    }

    @media (max-width:480px) {
        .selector{
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }
    }

    .bootstrap-tagsinput{
        width: 100%;
        padding: 8px 6px;
    }

    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white;
        background: #e31c79;
        padding: 2px;
        border-radius: 6px;
    }

    .invalid-feedback{
        display: block !important;
    }
</style>
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash d-flex">
                    <a href="{{route('backend.dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Home</a>
                    <a href="{{ route('backend.user.index')}}" class="breadcrumb-item">Contracts</a>
                    <span class="breadcrumb-item active">Add Contract</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title font-size-18">Add a Contract</h4>
            </div>
            <div class="card-body">
                {{-- @include('backend.partials.errors') --}}
                @php 
                  $route = route('backend.contract.store');
                  if(isset($contract)){
                     $route = route('backend.contract.update',$contract->id);
                  }
               @endphp
                <form action="{{$route}}" id="contract__form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($user)
                        @method('PUT')
                    @endisset
                    <div class="form-row">
                        <div class="col-md-12 mb-2">
                            <div class="container">
                                <div class="selector mx-auto">
                                    <div class="selecotr-item">
                                        <input type="radio" id="customer" name="user_type" value="customer" class="selector-item_radio" {{isset($contract) ?($contract->user_type=='customer'? 'checked': '') : 'checked'}}>
                                        <label for="customer" class="selector-item_label">Customer</label>
                                    </div>
                                    <div class="selecotr-item">
                                        <input type="radio" id="vendor" name="user_type" value="vendor" class="selector-item_radio" {{isset($contract) && $contract->user_type=='vendor'? 'checked': ''}}>
                                        <label for="vendor" class="selector-item_label">Vendor</label>
                                    </div>
                                    @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Upload your file here ( max 10mb)</div>
                                    <div class="file-upload">
                                        <input class="file-input" type="file" name="contract_file[]" accept=".pdf" id="attachment" multiple>
                                        <img src="{{asset('backend/assets/images/file-upload.png')}}" alt="">
                                        <div class="card-subtitle mt-2">Drag n Drop your file here</div>                   
                                    </div>
                                    
                                    <p id="files-area">
                                        <span id="filesList">
                                            <span id="files-names"></span>
                                        </span>
                                    </p>
        
                                    @error('contract_file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-row">
                        <div class="form-group col-md-4 cust__frag">
                            <label class="font-weight-semibold">Customer</label>
                            @php
                              $cust = isset($contract) ? $contract->user_id :old('customer');
                            @endphp
                            <select class="form-control" name="customer">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{$customer->id ?? ''}}" {{$cust==$customer->id ? 'selected' : ''}}>{{$customer->name ?? ''}}</option>
                                @endforeach
                            </select>
                            @error('customer')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 cust__frag">
                            <label class="font-weight-semibold">Salesperson</label>
                            <select class="form-control" name="salesperson_id">
                                
                            </select>
                            @error('salesperson_id')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 vend__frag" style="display: none">
                            @php
                                $vendor = isset($contract) ? $contract->user_id :old('vendor');
                            @endphp
                            <label class="font-weight-semibold">Vendor</label>
                            <select class="form-control" name="vendor">
                                <option value="">Select Vendor</option>
                                @foreach ($vendors as $vend)
                                    <option value="{{$vend->id ?? ''}}" {{$vendor==$vend->id ? 'selected' : ''}}>{{$vend->name ?? ''}}</option>
                                @endforeach
                            </select>
                            @error('vendor')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 vend__frag" style="display: none">
                            <label class="font-weight-semibold">Purchaser</label>
                            <select class="form-control" name="purchaser_id">
                                
                            </select>
                            @error('purchaser_id')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label class="font-weight-semibold">Start Date</label>
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input type="text" class="form-control datepicker-input" name="start_date" placeholder="Start date" value="{{isset($contract) ? $contract->getAttributes()['start_date'] : old('start_date')}}">
                            </div>
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-semibold">End Date</label>
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input type="text" class="form-control datepicker-input" name="end_date" placeholder="End date" value="{{isset($contract) ? $contract->getAttributes()['end_date'] : old('end_date')}}">
                            </div>
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        {{-- <div class="form-group col-md-4">
                            <label class="font-weight-semibold">Date Renewal</label>
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input type="date" class="form-control datepicker-input" name="renewal_date" placeholder="Renewal date" value="{{isset($contract) ? $contract->renewal_date : old('renewal_date')}}">
                            </div>
                            @error('renewal_date')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        <div class="form-group col-md-4">
                            <label class="font-weight-semibold">Renewal Interval</label>
                            <div class="input-affix m-b-10">
                                <select class="form-control" name="renewal_interval">
                                    <option value="">Select..</option>
                                    <option value="one_time" {{old('renewal_interval')=="one_time" ? 'selected' : ''}}>One Time</option>
                                    <option value="unlimited" {{old('renewal_interval')=="unlimited" ? 'selected' : ''}}>Unlimited</option>
                                </select>
                            </div>
                            @error('renewal_interval')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label class="font-weight-semibold">Renewal Reminder</label>
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input type="text" class="form-control datepicker-input" name="renewal_reminder_date" placeholder="Renewal Deadline date" value="{{isset($contract) ? $contract->getAttributes()['renewal_reminder_date'] : old('renewal_reminder_date')}}">
                            </div>
                            @error('renewal_reminder_date')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                           
                            <label class="font-weight-semibold">Estimated value of contract (annually):</label>
                            <input type="text" class="form-control" id="contract_value" name="contract_value" value="{{isset($contract) ? $contract->contract_value : old('contract_value')}}">
                            {{-- <input type="hidden" name="contract_value" value="{{isset($contract) ? $contract->contract_value : old('contract_value')}}"> --}}
                            @error('contract_value')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 cust__frag">
                            @php
                                $contract_type = isset($contract) ? $contract->contract_type :old('contract_type');
                            @endphp
                            <label class="font-weight-semibold">Contract Type</label>
                            <select class="form-control" name="contract_type">
                                <option value="">Select type</option>
                                <option value="normal" {{$contract_type=="normal" ? 'selected' : ''}}>Normal</option>
                                <option value="company" {{$contract_type=="company" ? 'selected' : ''}}>Company</option>
                            </select>
                            @error('contract_type')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 cust__frag">
                            @php
                                $extension = isset($contract) ? $contract->extension :old('extension');
                            @endphp
                            <label class="font-weight-semibold">Extension</label>
                            <select class="form-control" name="extension">
                                <option value="">Select type</option>
                                <option value="none" {{$extension=="none" ? 'selected' : ''}}>None</option>
                                <option value="automatic" {{$extension=="automatic" ? 'selected' : ''}}>Automatic</option>
                            </select>
                            @error('extension')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 cust__frag">
                            @php
                                $extension_period = isset($contract) ? $contract->extension_period :old('extension_period');
                            @endphp
                            <label class="font-weight-semibold">Extension Period</label>
                            <select class="form-control" name="extension_period">
                                <option value="">Select type</option>
                                <option value="none" {{$extension_period=="none" ? 'selected' : ''}}>None</option>
                                <option value="12-months" {{$extension_period=="12-months" ? 'selected' : ''}}>12 months</option>
                            </select>
                            @error('extension_period')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-row cust__frag">
                        <div class="form-group col-md-12">
                            <h4 class="font-weight-semibold">Performance/ KPI</h4>
                        </div>
                        <div class="form-group col-md-4">
                           
                            <label class="font-weight-semibold">Delivery degree:</label>
                            <input type="text" class="form-control" name="performance_delivery_degree" value="{{isset($contract) ? $contract->performance_delivery_degree : old('performance_delivery_degree')}}">
                            @error('performance_delivery_degree')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                           
                            <label class="font-weight-semibold">Delivery time:</label>
                            <input type="text" class="form-control" name="performance_delivery_time" value="{{isset($contract) ? $contract->performance_delivery_time : old('performance_delivery_time')}}">
                            @error('performance_delivery_time')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                           
                            <label class="font-weight-semibold">Quality:</label>
                            <input type="text" class="form-control" name="performance_quality" value="{{isset($contract) ? $contract->performance_quality : old('performance_quality')}}">
                            @error('performance_quality')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row cust__frag">
                        <div class="form-group col-md-12">
                            <h4 class="font-weight-semibold">Fines elements</h4>
                        </div>
                        <div class="form-group col-md-4">
                           
                            <label class="font-weight-semibold">Delivery degree:</label>
                            <input type="text" class="form-control" name="element_delivery_degree" value="{{isset($contract) ? $contract->element_delivery_degree : old('element_delivery_degree')}}">
                            @error('element_delivery_degree')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                           
                            <label class="font-weight-semibold">Delivery time:</label>
                            <input type="text" class="form-control" name="element_delivery_time" value="{{isset($contract) ? $contract->element_delivery_time : old('element_delivery_time')}}">
                            @error('element_delivery_time')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                           
                            <label class="font-weight-semibold">Quality:</label>
                            <input type="text" class="form-control" name="element_quality" value="{{isset($contract) ? $contract->element_quality : old('element_quality')}}">
                            @error('element_quality')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-row cust__frag">
                        
                        <div class="form-group col-md-4">
                            @php
                                $product_category = isset($contract) ? $contract->product_category :old('product_category');
                            @endphp
                            <label class="font-weight-semibold">Product Category</label>
                            <select class="form-control" name="product_category[]" multiple>
                                <option value="">Select type</option>
                                @foreach ($categories as $cat)
                                    <option value="{{$cat->id ?? ''}}" {{$product_category==$cat->id ? 'selected' : ''}}>{{$cat->category_name ?? ''}}</option>
                                @endforeach
                            </select>
                            @error('product_category')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-8">
                            <label class="font-weight-semibold">Delivery Instructions / guidelines :</label>
                            <input type="text" class="form-control" name="delivery_instructions" data-role="tagsinput" value="{{isset($contract) ? $contract->delivery_instructions : old('delivery_instructions')}}">
                            @error('delivery_instructions')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-12">
                            <h4 class="font-weight-semibold"><b>Meeting:</b></h4>
                        </div>
                        <div class="form-group col-md-4">
                           
                            <label class="font-weight-semibold">Status meeting:</label>
                            <input type="text" class="form-control" name="status_meeting" value="{{isset($contract) ? $contract->status_meeting : old('status_meeting')}}">
                            @error('status_meeting')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                           
                            <label class="font-weight-semibold">Meeting Date:</label>
                            <input type="text" class="form-control datepicker-input" name="meeting_date" value="{{isset($contract) ? $contract->meeting_date : old('meeting_date')}}">
                            @error('meeting_date')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary m-t-30">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <!-- Content Wrapper END -->

@endsection
@section('scripts')
<!-- Third Party Scripts(used by this page)-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
        $(".datepicker-input").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
        });

        numeral.register('locale', 'da-dk', {
            delimiters: {
                thousands: '.',
                decimal: ','
            },
            abbreviations: {
                thousand: 'k',
                million: 'mio',
                billion: 'mia',
                trillion: 'b'
            },
            ordinal: function (number) {
                return '.';
            },
            currency: {
                symbol: 'DKK'
            }
        });
        numeral.locale('da-dk');
        $('#contract_value').on('change', function(){
            var value=numeral($(this).val()).format('0.0,');
            $('[name="contract_value"]').val($(this).val());
            $(this).val(value);
        })
        
        $("[name='user_type']").on('change', function(){
            console.log(32323);
            if ($(this).val()=='customer') {
                $('.cust__frag').show(); 
                @if(!old('user_type'))
                    $("[name='customer']").val(''); 
                @else
                    $("[name='customer']").trigger('change')
                @endif
                $("[name='salesperson_id']").empty();

                $('.vend__frag').hide();
            }else{
                $('.vend__frag').show(); 
                @if(!old('user_type'))
                    $("[name='vendor']").val(''); 
                @else
                    $("[name='vendor']").trigger('change')
                @endif
                $("[name='purchaser_id']").empty();

                $('.cust__frag').hide();
            }
        })
    // $("[name='delivery_instructions']").tagsinput();
        @if( old('user_type'))
            $("[name='user_type']:checked").trigger('change');
        @endif

        $("[name='product_category[]']").select2();
        @if (old('product_category'))
            $("[name='product_category[]']").val({!! json_encode(old('product_category'))!!}).trigger('change');
        @endif
   })

    $("[name='customer']").on('change', function(){
        if ($(this).val()) {
            getOptions('customer',$("[name='customer']").val());
        }
    })

    $("[name='vendor']").on('change', function(){
        if ($(this).val()) {
            getOptions('vendor',$("[name='vendor']").val());
        }
    })

   function getOptions(type, id){
        $.ajax({
            url: "{{ url('/') }}/backend/options?type="+type+"&id="+id,
            type: 'GET',
            success: function (res) {
                // fullPageLoader(false);
                if (res.status) {
                    if (type=='customer') {
                        $("[name='salesperson_id']").html(res.options);
                    }else if(type=='vendor') {
                        $("[name='purchaser_id']").html(res.options);
                    }
                }
                else if(res.status) {
                    toastr.success(res.message)
                }
            }
        });
   }
</script>

<script>
    const dt = new DataTransfer();

    $("#attachment").on('change', function(e){
        for(var i = 0; i < this.files.length; i++){
            let fileBloc = $('<span/>', {class: 'file-block'}),
                fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
            fileBloc.append('<span class="file-delete"><span>+</span></span>')
                .append(fileName);
            $("#filesList > #files-names").append(fileBloc);
        };
        // Ajout des fichiers dans l'objet DataTransfer
        for (let file of this.files) {
            dt.items.add(file);
        }
        // Mise à jour des fichiers de l'input file après ajout
        this.files = dt.files;

        // EventListener pour le bouton de suppression créé
        $('span.file-delete').click(function(){
            let name = $(this).next('span.name').text();
            // Supprimer l'affichage du nom de fichier
            $(this).parent().remove();
            for(let i = 0; i < dt.items.length; i++){
                // Correspondance du fichier et du nom
                if(name === dt.items[i].getAsFile().name){
                    // Suppression du fichier dans l'objet DataTransfer
                    dt.items.remove(i);
                    continue;
                }
            }
            // Mise à jour des fichiers de l'input file après suppression
            document.getElementById('attachment').files = dt.files;
        });
    });
</script>

@endsection
