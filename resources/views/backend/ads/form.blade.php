
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
                    <a href="{{route('backend.dashboard')}}" class="breadcrumb-item"><i class="anticon anticon-home m-{{$alignShort}}-5"></i>Home</a>
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
                                <img id="preview" class="preview_image mt-3" src="{{ asset('/storage/ad_images/'.$ad->image) }}"/>
                            @else
                                <img id="preview" class="preview_image mt-3" style="display: none;"/>
                            @endif
                        </div>
                        {{-- <div class="form-group col-12">

                        </div> --}}
                    </div>
                    <hr>
                    <div class="form-row cust__frag">
                        <div class="form-group col-12">

                            <label class="font-weight-semibold">Ad URL:</label>
                            <input type="text" class="form-control" name="ad_url" value="{{isset($ad) ? $ad->ad_url : old('ad_url')}}">
                            @error('ad_url')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-600">Select Sites (Multiple sites can be added)</label>
                            <select name="sites[]" class="form-control select2" multiple>
                                @foreach($sites as $site)
                                    <option value="{{ $site->id }}" @if(isset($ad) && in_array($site->id, $selectedSites)) selected @endif>{{ $site->site_name }}</option>
                                @endforeach
                            </select>
                            @error('sites')
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

        $('.select2').select2();
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

        // $("[name='sites']").tagsinput();

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
