
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
        content: '';
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

    .checkbox-group input:checked+label:after {
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

    .select2-search:after {
        top: 10px !important;
        font-size: 18px !important;
    }

    .select2-container--default .select2-selection--multiple {
        padding: 0.55rem 1rem !important;
        border: 1px solid #d1d7dd !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #e31c79;
        border: 1px solid #e31c79;
        color: white;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
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

    .file-block>span.name {
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

    .file-delete>span {
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

    .selector {
        position: relative;
        width: 34%;
        background-color: var(--smoke-white);
        display: flex;
        justify-content: space-around;
        align-items: center;
        border-radius: 9999px;
        border: 2px solid #f2f2f2;
    }

    .selecotr-item {
        position: relative;
        flex-basis: calc(100% / 2);
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .selector-item_radio {
        appearance: none;
        display: none;
    }

    .selector-item_label {
        position: relative;
        height: 80%;
        width: 100%;
        text-align: center;
        border-radius: 9999px;
        line-height: 400%;
        font-weight: 900;
        transition-duration: .5s;
        transition-property: transform, color, box-shadow;
        transform: none;
        margin-bottom: 0;
    }

    .selector-item_radio:checked+.selector-item_label {
        background-color: #e31c79;
        color: var(--white);
        /* box-shadow:0 0 4px rgba(0,0,0,.5),0 2px 4px rgba(0,0,0,.5); */
        transform: translateY(-2px);
    }

    .custom-input-file {
        width: .1px;
        height: .1px;
        opacity: 0;
        outline: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1
    }

    .custom-input-file+label {
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        display: block;
        overflow: hidden;
        padding: 10px 20px;
        padding: .625rem 1.25rem;
        border: 1px solid #e0e6ed;
        border-radius: .25rem;
        color: #8492a6;
        background-color: #fff;
        outline: 0;
        margin: 0
    }

    .custom-input-file+label i {
        width: 1em;
        height: 1em;
        vertical-align: middle;
        fill: currentColor;
        margin-top: -.25em;
        margin-right: .5em
    }

    .custom-input-file+label:hover,
    .custom-input-file.has-focus+label,
    .custom-input-file:focus+label {
        background-color: #fff
    }

    .no-js .custom-input-file+label {
        display: none
    }

    .custom-input-file--2+label {
        color: #fff;
        border-color: #283b8c;
        background: #283b8c
    }

    .custom-input-file--2+label:hover,
    .custom-input-file--2.has-focus+label,
    .custom-input-file--2:focus+label {
        color: #fff;
        border-color: #fcb41a;
        background: #fcb41a
    }

    .custom-input-file-link+label {
        padding: 0;
        border: 0;
        background: 0 0;
        color: #6e00ff;
        font-size: 14px;
        font-size: .875rem;
        font-weight: 600
    }

    .custom-input-file-link+label:hover,
    .custom-input-file-link.has-focus+label,
    .custom-input-file-link:focus+label {
        background-color: transparent
    }

    .custom-input-file {
        width: unset !important;
        height: unset !important;
    }

    .preview_image{
        width: auto;
        height: 200px;
    }

    .dropdowns:first-child .remove-btn {
        display: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b:before {
        content: "";
        display: none;
    }

    .select2-container .select2-selection--single {
        height: 43px;
        background-color: #fff;
        border: 1px solid #d9d9d9;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        top: 80%;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 40px;
    }

    @media (max-width:480px) {
        .selector {
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }

        .preview_image{
            width: auto;
            height: 150px;
        }
    }

    .bootstrap-tagsinput {
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

    .invalid-feedback {
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
                    <a href="{{route('backend.adsListing')}}" class="breadcrumb-item"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Ads Directory</a>
                    <a href="{{ route('backend.adsListing')}}" class="breadcrumb-item">Ads</a>
                    <span class="breadcrumb-item active">{{ isset($ad) && $ad ? 'Update Ad' : 'Add Ad' }}</span>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title font-size-18">{{ isset($ad) && $ad ? 'Update Ad' : 'Add New Ad' }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('backend.adStore') }}" id="contract__form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ((isset($ad) && $ad))
                            <input type="hidden" name="adId" value="{{$ad->id}}">
                    @endif
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="" class="font-weight-600">Ad Image</label>
                            <input type="file" name="ad_image" id="ad_image" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected"/>
                            <label for="ad_image">
                                <i class="fas fa-upload"></i>
                                <span >Choose Image!</span>
                            </label>
                            @error('ad_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if (isset($ad) && $ad)
                                <img id="preview" class="preview_image mt-3" src="{{ $ad->image }}"/>
                            @else
                                <img id="preview" class="preview_image mt-3" style="display: none;"/>
                            @endif
                        </div>
                    </div>
                    <hr>
                    {{-- <div class="form-row">
                        <div class="form-group col-12">

                            <label class="font-weight-semibold">Ad URL:</label>
                            <input type="text" placeholder="Ender Ad URL!" class="form-control" name="ad_url" value="{{isset($ad) ? $ad->ad_url : old('ad_url')}}">
                            @error('ad_url')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="form-row">
                        <div class="form-group col-6">

                            <label class="font-weight-semibold">Ad Expiry:</label>
                            <input type="date" placeholder="Ender Ad Expiry" class="form-control" name="ad_expiry" value="{{isset($ad) ? \Carbon\Carbon::parse($ad->ad_expiry)->format('Y-m-d')  : old('ad_expiry')}}">
                            @error('ad_expiry')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6">
    
                            <label class="font-weight-semibold">Ad Limit:</label>
                            <input type="text" placeholder="Ender Ad Limit" class="form-control" name="ad_limit" value="{{isset($ad) ? $ad->ad_limit : old('ad_limit')}}">
                            @error('ad_limit')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row repeater">
                        <div class="col-12">
                            <div data-repeater-list="site_data">
                                <div data-repeater-item>
                                    <div class="row mb-3">
                                        <div class="col-5">
                                            <select name="site_id" class="select2 form-control site-dropdown">
                                                <option value="" disabled selected>Select Site</option>
                                                @foreach($sites as $site)
                                                    <option value="{{ $site->id }}">{{ $site->site_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <div class="col-5">
                                            <select name="slot_id" class="select2 form-control slot-dropdown">
                                                <option value="" disabled selected>Select Slot</option>
                                                @foreach($slots as $slot)
                                                    <option value="{{ $slot->id }}">{{ $slot->slot_number }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        <div class="form-group col-5">
                                            <input type="text" placeholder="Enter Ad URL!" class="form-control" name="ad_url">
                                        </div>
                                        <div class="form-group col-2">
                                            <input type="text" placeholder="Enter Ad Limit" class="form-control" name="ad_limit">
                                        </div>
                                        <div class="col-2">
                                            <input data-repeater-delete type="button"  class="btn btn-danger" value="Delete" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-5">
                                            @error('site_data.0.site_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-5">
                                            @error('site_data.0.slot_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input data-repeater-create type="button" class="btn btn-primary"  value="Add More"/>
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
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function(){
        disableTheSelectedInputs();
        $('.select2').select2();

      var repeater_elem =  $('.repeater').repeater({
            show: function () {
                $(this).slideDown();
                $('.select2-container').remove();
                $('.select2').select2();

                $('.select2-container').css('width','100%');
                disableTheSelectedInputs();
            },
            hide: function (remove) {
                $(this).slideUp(remove);
                disableTheSelectedInputs();
            },
            isFirstItemUndeletable: true
        });

        @if (session()->has('site_data_error'))
            var tasks={!!json_encode(session()->get('site_data_error'))!!};
            repeater_elem.setList(tasks);
        @endif

        @if (isset($selectedSites))
            var tasks={!!json_encode($selectedSites)!!};
            repeater_elem.setList(tasks);
        @endif
    });

    $(document).on('change', '.site-dropdown', function() {
        disableTheSelectedInputs();
    });
    var selectedSites = [];
    function disableTheSelectedInputs() {
        // enable all options in the site dropdowns
        $('.site-dropdown option').prop('disabled', false);

        // loop through all site dropdowns
        $('.site-dropdown').each(function() {
            // get the selected value of the current dropdown
            var selectedValue = $(this).val();

            // if the selected value is not empty
            if (selectedValue) {
                // push it into the selectedSites array
                selectedSites.push(selectedValue);

                // disable the option with the selected value in all other dropdowns
                $('.site-dropdown').not(this).find('option[value="'+selectedValue+'"]').prop('disabled', true);
            }
        });
    }

    $("[name='ad_image']").change(function() {
        $('#thiss').html("");
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#thiss').html(
                "OOps! can not upload this image, make sure you have selected the supported image format. 'jpeg', 'jpg', 'png', 'gif'");
            $('#thisss').html("");

        } else {
            readURL(this);
            $('#thiss').html("");
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            $(".preview_image").show(300);
            reader.onload = function (e) {
                $('#preview')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
