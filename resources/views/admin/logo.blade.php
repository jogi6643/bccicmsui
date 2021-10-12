@extends('base')
@section('title', 'Logo Management')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
<style>
    form.form-horizontal h3.heading {
        font-size: 20px;
        margin-bottom: 29px;
        font-weight: 400;
        background: #0186cb;
        color: #fff;
        padding: 12px;
        border-radius: 3px;
        position: relative;
        top: -10px;
    }

    .d-none{ display: none; }

</style>
<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Dashbord</a></li>
            <li class="active"></li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<!-- .row -->
<div class="row">
    <div class="col-md-12">
        <div class="content_text headbar">
            <p>Logo Management</p>
        </div>
    </div>    
    <div class="col-md-4">
        <div class="white-box"style="padding:40px;">
            <!-- <h3 class="box-title m-b-0">Internal EPIC ON Display Ads</h3> -->
            <form class="form-horizontal addnewlogo" method="post" action="{{ route('saveLogo') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h3 class="heading">Add New Logo</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Logo Title</label>
                            <div class="col-sm-8">
                                <input  type="text" class="form-control" name="title" id="title" value="" />
                                @if ($errors->has('title'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Logo</label>
                            <div class="col-sm-8">
                                <input type="file" multiple class="dropify" data-default-file="" data-allowed-file-extensions="jpg jpeg png gif tiff psd pdf eps ai indd raw" id="logo" name="logo">
                                @if ($errors->has('logo'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Publish Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control dtpicker" value="" name="publish_date">
                                <input type="time" class="form-control tmpicker" value="" name="start_time">
                                @if ($errors->has('publish_date'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('publish_date') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Expiry Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control dtpicker" value="" name="expiry_date">
                                <input type="time" class="form-control tmpicker" value="" name="end_time">
                                @if ($errors->has('expiry_date'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('expiry_date') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>    
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select Platform</label>
                            <div class="col-sm-8">
                                <select name="platform" id="platform" class="form-control">
                                    <option value="">Select Platform</option>
                                    @foreach($data['platformData'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('platform'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('platform') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select Logo Category</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="category" id="category">
                                    <option value="">Select</option>
                                    @foreach($data['categoryData'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>    
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="form-group " style="margin-top: 25px">
                            <label for="behName1" class="col-sm-4 control-label">Location Search :</label>
                            <div class="col-sm-8">
                                <button type="button" class="location-search">Search</button> 
                            </div>
                        </div>  
                    </div>  -->
                    <div class="col-md-12">
                        <div class="form-group" >
                            <label for="wfirstName2" class="col-sm-4 control-label">Location:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="" id="location" name="location" placeholder="Choose Location">
                                @if ($errors->has('location'))
                                <div class="error" role="alert">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="behName1" class="col-sm-4 control-label">Latitude :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="" id="latitude" name="latitude"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="behName1" class="col-sm-4 control-label">Longitude:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="" id="logitude" name="logitude"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-right-content form-groups geo-blocking">
                            <h3>Geo Blocking </h3>
                            <!-- <input type="checkbox" id="select_all" name="select_all" value="Select all"> -->
                            <!-- <label for="select_all">Select all</label><br> -->
                            <label for="shortDescription3">Custom Select country</label>
                            <select class="selectpicker form-control" multiple data-actions-box="true" name="country[]">
                                <option value="">Select</option>
                                @foreach($data['countryData'] as $country)
                                <option value="{{ $country['country_flag'] }}">{{ $country['country_name'] }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country'))
                            <div class="error" role="alert">
                                <strong>{{ $errors->first('country') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>    
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <!-- <input type="hidden" name="type" id="tag-type" value=""> -->
                        <button type="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                        <button type="button" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Cancel</button>
                    </div>
                </div>
            </form>
            <form class="form-horizontal editnewlogo" id="form-update-logo" method="post" action="{{ route('updateLogo') }}" enctype="multipart/form-data" style="display: none">
                {{ csrf_field() }}
                <input type="hidden" id="edit_logo_id" name="logo_id">
                <input type="hidden" id="edit_image_url" name="image_url">

                <h3 class="heading">Update Logo</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Logo Title</label>
                            <div class="col-sm-8">
                                <input  type="text" class="form-control" name="title" id="edit_title" value="" />
                                <div class="error d-none" role="alert">
                                    <strong>The title field is required.</strong>
                                </div>
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Logo</label>
                            <div class="col-sm-8">
                                <input type="file" multiple class="dropify" data-default-file="img/no-image.png" data-allowed-file-extensions="jpg jpeg png gif tiff psd pdf eps ai indd raw" id="edit_logo" name="logo">
                                <div class="error d-none" role="alert">
                                    <strong>The logo field is required.</strong>
                                </div>
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Publish Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control dtpicker" value="" id="edit_publish_date" name="publish_date">
                                <input type="time" class="form-control tmpicker" value="" id="edit_start_time" name="start_time">
                                <div class="error d-none" role="alert">
                                    <strong>The publish date field is required.</strong>
                                </div>
                            </div>
                        </div>    
                    </div>  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Expiry Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control dtpicker" value="" id="edit_expiry_date" name="expiry_date">
                                <input type="time" class="form-control tmpicker" value="" id="edit_end_time" name="end_time">
                                <div class="error d-none" role="alert">
                                    <strong>The expiry date field is required.</strong>
                                </div>
                            </div>
                        </div>    
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select Platform</label>
                            <div class="col-sm-8">
                                <select name="platform" id="edit_platform" class="form-control">
                                    <option value="">Select Platform</option>
                                    @foreach($data['platformData'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <div class="error d-none" role="alert">
                                    <strong>The platform field is required.</strong>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select Logo Category</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="category" id="edit_category">
                                    <option value="">Select</option>
                                    @foreach($data['categoryData'] as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <div class="error d-none" role="alert">
                                    <strong>The category field is required.</strong>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <!-- <div class="col-md-12">
                        <div class="form-group " style="margin-top: 25px">
                            <label for="behName1" class="col-sm-4 control-label">Location Search :</label>
                            <div class="col-sm-8">
                                <button type="button" class="location-search">Search</button> 
                            </div>
                        </div>  
                    </div>  -->
                    <div class="col-md-12">
                        <div class="form-group" >
                            <label for="wfirstName2" class="col-sm-4 control-label">Location:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="" id="edit_location" name="location">
                                <div class="error d-none" role="alert">
                                    <strong>The location field is required.</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="behName1" class="col-sm-4 control-label">Latitude :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="" id="edit_latitude" name="latitude"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="behName1" class="col-sm-4 control-label">Longitude:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly="" value="" id="edit_logitude" name="logitude"> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-right-content form-groups geo-blocking">
                            <h3>Geo Blocking </h3>
                            <!-- <input type="checkbox" id="select_all" name="select_all" value="Select all"> -->
                            <!-- <label for="select_all">Select all</label><br> -->
                            <label for="shortDescription3">Custom Select country</label>
                            <select class="selectpicker form-control" multiple data-actions-box="true" id="edit_country" name="country[]">
                                <option value="">Select</option>
                                @foreach($data['countryData'] as $country)
                                <option value="{{ $country['country_flag'] }}">{{ $country['country_name'] }}</option>
                                @endforeach
                            </select>
                            <div class="error d-none" role="alert">
                                <strong>The country field is required.</strong>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <button type="button" name="submit" id="btnUpdate" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                        <button type="button" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10 btnCancel">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="white-box"style="padding:40px;width: 100%">
            @include('show_message')
            <div class="alert alert-success update-suc-msg d-none"></div>
            <div class="alert alert-danger update-err-msg d-none"></div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered results listing_table list_view logo-management">
                    <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>Id</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Platform</th>
                            <th>Publish Date</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data['records']) > 0)
                            @foreach($data['records'] as $record)
                                <tr>
                                    <!-- <td><input value="555685" name="check_video" class="checkbox check_video form-element" type="checkbox"></td> -->
                                    <td>{{ $record['ID'] }}</td>
                                    <td>{{ $record['name'] }}</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $record['category'])) }}</td>
                                    <td>{{ strtoupper($record['platform']) }}</td>
                                    <td>{{ date('d M Y h:i A', strtotime($record['start_date']))  }}</td>
                                    <td>{{ date('d M Y h:i A', strtotime($record['end_date']))  }}</td>
                                    <td class="action">
                                        <a class="view1 open-data tdaction viewLogo" title="View" data-target="#Viewpage" title="" data-toggle="modal" data-id="{{ $record['ID'] }}" data-original-title="view">
                                            <span class="ti-eye"></span>
                                        </a>
                                        <a class="view1 tdaction edit" title="" data-toggle="tooltip" href="javascript:void(0);" data-original-title="Edit" data-id="{{ $record['ID'] }}">
                                            <span class="ti-pencil-alt"></span>
                                        </a>
                                        <a class="view_delete single_delete_icon tdaction" href="javascript:void(0);" data-id="{{ $record['ID'] }}" title="Delete" data-toggle="modal" data-target=".delete-modal">
                                            <span class="ti-trash"></span>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        @else	
                            <tr>
                                <td colspan="7" class="text-center">No records found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <nav aria-label="..." class="paginations">
                <ul class="pagination right">
                    @foreach ($data['link'] as $link)
                        <li class="page-item {{ $link['active'] == 1 ? 'active' : '' }}">
                            @php
                            if (str_contains($link['label'], 'Next')) {
                                $page = $data['current_page'] + 1;
                            }elseif (str_contains($link['label'], 'Previous')) {
                                $page = $data['current_page'] - 1;
                            }else{
                                $page = $link['label'];
                            }
                            @endphp
                            <a class="page-link" href="{{ $link['url'] ? url('/logo').'/'.$page : 'javascript:void(0)' }}">
                                {!! $link['label'] !!}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>    
    </div>    
</div>
  
<div class="modal fade" id="Viewpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 100%; margin: 0 auto;">
            <div class="modal-header">
                <h2 class="Preview-title">Preview Logo</h2>
                <!-- <a class="recent-content__add btn primary medium rightbtn" href="#">Edit Detail</a> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body wizard-content">
                <form data-parsley-validate action="{{ route('addArticle') }}" name="article_form" id="article_form" method="post" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                    <h6>Basic Info</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="pdlt" for="wfirstName2">  <span class="date" id="publishTo"></span>
                                    </label>
                                    <h2 id="title" class="head-title"></h2>
                                </div>
                                <div class="form-group">
                                    <label class="pdlt" for="wfirstName2">
                                        Logo Title:
                                        <span class="date" id="v-title"></span><br/>
                                        Publish Date: 
                                        <span class="date" id="v-publishDate"></span>
                                        <br/>Expiry Date: 
                                        <span class="date" id="v-expiryDate"></span><br/>
                                        Platform: 
                                        <span class="date" id="v-platform"></span><br/>
                                        Logo Category: 
                                        <span class="date" id="v-category"></span><br/>
                                        Location: 
                                        <span class="date" id="v-location"></span><br/>
                                        Country: 
                                        <span class="date" id="v-country"></span><br/>
                                    </label>
                                    <!--<div class="date" id="publishTo"></div> --> 
                                </div>
                            </div>
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label for="wlastName2" class="pdlt description" style="">  </label>
                                    <img src="http://dev.bccicms.epicon.in/assets/images/bcci2.jpeg" id="v-photo" name="v-photo" alt="Trulli" class="art-img">
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="delete-modal fade swal-overlay swal-overlay--show-modal" tabindex="-1" role="dialog" style="display:none;">
        <div class="swal-modal" role="dialog" aria-modal="true">
            <form method="post" id="form-delete" action="{{ route('deleteLogo') }}">
                @csrf
                <input type="hidden" id="logo_id" name="logo_id" value="">
                <div class="swal-icon swal-icon--error">
                    <div class="swal-icon--error__x-mark">
                        <span class="swal-icon--error__line swal-icon--error__line--left"></span>
                        <span class="swal-icon--error__line swal-icon--error__line--right"></span>
                    </div>
                </div>
                <div class="swal-title" style="">Are you sure?</div>
                <div class="swal-text" style="">Are you sure you want to delete?</div>
                <div class="swal-footer">
                    <div class="swal-button-container">
                        <button type="button" class="swal-button swal-button--cancel" data-dismiss="modal">Cancel</button>
                        <div class="swal-button__loader">
                        
                        </div>
                    </div>
                    <div class="swal-button-container">
                        <button type="button" class="swal-button swal-button--confirm btn-ok" data-dismiss="modal">OK</button>
                        <div class="swal-button__loader">
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
<script type="text/javascript">
//For Add Logo Form 
google.maps.event.addDomListener(window, 'load', initialize);
function initialize() {
    var input = document.getElementById('location');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        $('#latitude').val(place.geometry['location'].lat());
        $('#logitude').val(place.geometry['location'].lng());
    });
}

//For Update Logo Form 
google.maps.event.addDomListener(window, 'load', initialize1);
function initialize1() {
    var input = document.getElementById('edit_location');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        $('#edit_latitude').val(place.geometry['location'].lat());
        $('#edit_logitude').val(place.geometry['location'].lng());
    });
}

setTimeout(function() {
    $('.alert-success').fadeOut('slow');
    $('.alert-danger').fadeOut('slow');
}, 5000);

$(document).ready(function() {

    $('.single_delete_icon').click(function(){
        var logo_id  = $(this).attr('data-id');
        $('#logo_id').val(logo_id);
    })

    $('.btnCancel').click(function(){
        $("form.form-horizontal.addnewlogo").toggle();
        $("form.form-horizontal.editnewlogo").toggle();
    })

    $('.btn-ok').click(function(){
        $('#form-delete').submit();
    })

    $('.viewLogo').click(function(){
        var logo_id = $(this).attr('data-id');
        if(logo_id != ''){
            $('.preloader').show();
            $.ajax({
                url: APP_URL + '/viewLogo',
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'logo_id' : logo_id,
                    'type' : 'view'
                },
                dataType: 'text',
                success: function(data) {
                    $('.preloader').hide();
                    var response = $.parseJSON(data);
                    if(response.status.code == 200 && response.payload){
                        data = response.payload;
                        $('#v-title').text(data.name);
                        $('#v-publishDate').text(data.start_date);
                        $('#v-expiryDate').text(data.end_date);
                        $('#v-platform').text(data.platform);
                        $('#v-category').text(data.category);
                        $('#v-location').text(data.location);
                        $('#v-country').text(data.country);
                        $('#v-photo').attr('src', data.image_url);
                    }else{
                        alert(response.status.message);
                    }
                }
            });
        }
    })

    $("a.view1.tdaction.edit").click(function(){
        $("form.form-horizontal.addnewlogo").hide();
        $("form.form-horizontal.editnewlogo").show();
        var logo_id = $(this).attr('data-id');

        if(logo_id != ''){
            $('.preloader').show();
            $.ajax({
                url: APP_URL + '/viewLogo',
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'logo_id' : logo_id,
                    'type' : 'edit'
                },
                dataType: 'text',
                success: function(data) {
                    $('.preloader').hide();
                    var response = $.parseJSON(data);
                    if(response.status.code == 200 && response.payload){
                        data = response.payload;
                        $('#edit_logo_id').val(logo_id);
                        $('#edit_image_url').val(data.image_url);
                        $('#edit_title').val(data.name);
                        $("#edit_publish_date").val(data.start_date);
                        $('#edit_expiry_date').val(data.end_date);
                        $('#edit_start_time').val(data.start_time);
                        $('#edit_end_time').val(data.end_time);
                        $('#edit_platform').val(data.platform);
                        $('#edit_category').val(data.category);
                        $('#edit_location').val(data.location);
                        $('#edit_logitude').val(data.logitude);
                        $('#edit_latitude').val(data.latitude);
                        $('#edit_country').selectpicker('val', data.country);
                        $('.dropify-render > img').attr('src', data.image_url);
                        
                    }else{
                        alert(response.status.message);
                    }
                }
            });
        }
    });  
    
    $('#btnUpdate').click(function(){
        
        var title = $('#edit_title').val();
        var logo = $('#edit_logo').val();
        var publish_date = $('#edit_publish_date').val();
        var expiry_date = $('#edit_expiry_date').val();
        var platform = $('#edit_platform').val();
        var category = $('#edit_category').val();
        var location = $("#edit_location").val();
        var country = $("#edit_country").val();
        var flag = 1;

        $('#form-update').find('.error').css('display', 'none');

        if(title == ''){
            $('#edit_title').parent().find('.error').css('display', 'block');
            flag = 0;
        }else{
            $('#edit_title').parent().find('.error').css('display', 'none');
        }

        if(publish_date == ''){
            $('#edit_publish_date').parent().find('.error').css('display', 'block');
            flag = 0;
        }else{
            $('#edit_publish_date').parent().find('.error').css('display', 'none');
        }

        if(expiry_date == ''){
            $('#edit_expiry_date').parent().find('.error').css('display', 'block');
            flag = 0;
        }else{
            $('#edit_expiry_date').parent().find('.error').css('display', 'none');
        }

        if(platform == ''){
            $('#edit_platform').parent().find('.error').css('display', 'block');
            flag = 0;
        }else{
            $('#edit_platform').parent().find('.error').css('display', 'none');
        }

        if(category == ''){
            $('#edit_category').parent().find('.error').css('display', 'block');
            flag = 0;
        }else{
            $('#edit_category').parent().find('.error').css('display', 'none');
        }

        if(location == ''){
            $('#edit_location').parent().find('.error').css('display', 'block');
            flag = 0;
        }else{
            $('#edit_location').parent().find('.error').css('display', 'none');
        }

        if(country == ''){
            $('#edit_country').parent().find('.error').css('display', 'block');
            flag = 0;
        }else{
            $('#edit_country').parent().find('.error').css('display', 'none');
        }

        if(flag == 1){
            $('.preloader').show();
            var form = $('#form-update-logo')[0];
            var formData = new FormData(form);
            
            $.ajax({
                url: APP_URL + '/updateLogo',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                dataType: "JSON",
                success: function(response) {
                    $('.preloader').hide();
                    if(response.status.code == 200){
                        $('.update-suc-msg').text(response.status.message);
                        $('.update-suc-msg').show();
                    }else{
                        $('.update-err-msg').text(response.status.message);
                        $('.update-err-msg').show();
                    }
                    $(window).scrollTop(0);
                }
            });
        }
    })

});    
</script>

@stop