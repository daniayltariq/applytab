
@extends('backend.layouts.app')

@section('styles')
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
                    <a href="{{route('backend.advertiser.index')}}" class="breadcrumb-item"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Advertisers Directory</a>
                    <a href="{{ route('backend.advertiser.index')}}" class="breadcrumb-item">Advertisers</a>
                    <span class="breadcrumb-item active">{{ isset($adv) && $adv ? 'Update Advertiser' : 'Add Advertiser' }}</span>
                </nav>
            </div>
        </div>
        
        <form class="row" action="{{ route('backend.advertiser.store') }}" id="contract__form" method="POST" enctype="multipart/form-data">
            @csrf
            @if ((isset($adv) && $adv))
                    <input type="hidden" name="adv_id" value="{{$adv->id}}">
            @endif
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-size-18">{{ isset($adv) && $adv ? 'Update Advertiser' : 'Add New Advertiser' }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-10 mx-auto">
    
                                <label class="font-weight-semibold">Name:</label>
                                <input type="text" placeholder="Enter Name" class="form-control" name="name" value="{{isset($adv) ?   $adv->inst_name: old('name')}}">
                                @error('inst_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-10 mx-auto">
                                @php
                                    $type__=$adv->type->id ?? null;
                                    // dd($type__);
                                @endphp
                                <label class="font-weight-semibold">Type:</label>
                                <select name="type" class="form-control">
                                    <option value="" disabled selected>Select type...</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{$type__ && $type__==$type->id ? 'selected' : ''}}>{{ $type->inst_type_name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-10 mx-auto">
        
                                <label class="font-weight-semibold">Acronym</label>
                                <input type="text" placeholder="Ender Ad Limit" class="form-control" name="acronym" value="{{isset($adv) ? $adv->acronym : old('acronym')}}">
                                @error('acronym')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </div>
                            <div class="col-md-12">
                                <a href="{{route('backend.advertiser.index')}}" class="btn btn-danger w-100 mt-3">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Content Wrapper END -->

@endsection
@section('scripts')
<!-- Third Party Scripts(used by this page)-->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function(){
       
    });

</script>

@endsection
