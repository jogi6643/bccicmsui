@extends('base')
@section('epic_content')
@section('title', 'Update Video')
<?php
// dd($edit_data);
$type = isset($_GET['type']) ? $_GET['type'] : ''; ?>
<?php error_reporting(E_ALL & ~E_NOTICE); ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- My add file -->
<!-- Tiny MCE editor -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- include libraries(jQuery, bootstrap) -->
<!-- summernote -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<!-- End summernote-->
<!-- <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script> -->

<style type="text/css">
    .modal-title {
        margin: 0;
        line-height: 1.42857143;
        text-align: center;
        color: #1a457d;
        font-weight: 400;
    }
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
            <li class="active"><a href="{{ url('uploadcontent') }}">Upload Content</a></li>
            <!-- <li class="active"></li> -->
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>
<?php
//pr($edit_data);die;
?>

<div class="modal-dialog modal-lg" style="width:100%">
    <div class="modal-content">
        <div class="modal-header upload" style="padding:5px 15px;">

            <h4 class="card-title head-title">Update Video</h4>
        </div>
        <div class="modal-body upload-body">
            <div class="row">
                <div class="col-12">
                    <div class="white-box">
                        <div class="card-body wizard-content">

                            <h6 class="card-subtitle">Complete All the steps to add new</h6>
                            <label class="control-label">Asset Type</label>
                            <div class="">
                                <select class=" form-control" name="asset_type" id="asset_type" disabled>
                                    <option value="">Select</option>
                                    <option value="articles">Articles</option>
                                    <option value="photos">Photos</option>
                                    <option value="playlists">Playlists</option>
                                    <option value="videos" selected>Videos</option>
                                    <option value="audio">Audio</option>
                                    <option value="promos">Promos</option>
                                    <option value="documents">Documents</option>
                                    <option value="bios">Bios</option>
                                </select>
                            </div>
                            <!--  -->
                            @include('show_message')

                            <form action="{{ url('updateVideo') }}" name="video_form" id="video_form" method="POST" enctype="multipart/form-data" class="validation-wizard wizard-circle">
                                <!-- Step 1 -->
                                {{ csrf_field() }}
                                <button type="button" id="collapsesidebar-btn" class="collapse-btn">
                                    <span> Collapse sidebar</span>
                                </button>
                                <h6>Basic Info</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wfirstName2"> Headline*:</label>
                                                <input type="text" class="form-control text-case" name="title" value="{{ old('title', $edit_data['title'] ?? '') }}" required>
                                                <input type="hidden" name="ID" value="{{ isset($edit_data['ID']) ? $edit_data['ID'] : $edit_data['id'] }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wfirstName2"> URL Segment:</label>
                                                <br />
                                                <div class="input_field">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="text" name="titleUrlSegment" onfocusout="save_url();" value="{{ old('titleUrlSegment', $edit_data['titleUrlSegment'] ?? '') }}" readonly>
                                                        </div>
                                                        <!--
                                                        <div class="col-md-4">
                                                            <button type="button" class="btn"
                                                                onclick="editable_segment();"><i
                                                                    class="glyphicon glyphicon-edit single_edit_icon"
                                                                    id="edit_field"></i></button>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 clear-b">
                                            <div class="form-group">
                                                <label for="myfile">Add Video :</label>
                                                @if (isset($edit_data['video_url']))
                                                <input type="file" class="dropify" accept="video/mp4,video/x-m4v,video/*" data-default-file="{{ $edit_data['video_url'] }}" id="myfile" name="videofile" value="{{ old('videofile') }}">
                                                @else
                                                <input type="file" class="dropify" accept="video/mp4,video/x-m4v,video/*" data-default-file="" id="myfile" name="videofile" value="">
                                                @endif
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wlastName2"> Photo editor:</label>
                                                <textarea class="form-control "  name="description" rows="3">{{ old('description', $edit_data['description'] ?? '') }}</textarea>
                                            </div>
                                        </div>     -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="myfile">Thumbnail Image:</label>
                                                <input type="file" class="dropify" accept="image/*" data-default-file="{{ $edit_data['imageUrl'] }}" id="myfile" name="thumbnail_image" value="{{ old('imageUrl') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="myfile">Banner Image:</label>
                                                <input type="file" class="dropify" accept="image/*" data-default-file="{{ $edit_data['imageUrl'] }}" id="myfile" name="imageUrl" value="{{ old('imageUrl') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="myfile">Vertical Image:</label>
                                                <input type="file" class="dropify" accept="image/*" data-default-file="{{ $edit_data['imageUrl'] }}" id="myfile" name="imageUrl" value="{{ old('imageUrl') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="behName1">Video URL :</label>

                                                <input type="text" class="form-control" value="{{ old('video_url', $edit_data['video_url'] ?? '') }}" name="video_url">

                                            </div>
                                        </div>
                                    </div>

                                    <!-- </div> -->
                                </section>
                                <!-- Dynamic Tab -->
                    <h6>Meta Information</h6>
                    <section>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wemailAddress2"> Short Description*:</label>
                                <textarea class="form-control" id="short_description" name="short_description" rows="3" value="">{{ old('short_description', $edit_data['short_description'] ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="wlastName2"> Description*:</label>
                                <textarea class="form-control" name="description" rows="3" value="">{{ old('description', $edit_data['description'] ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Video Duration* :</label>
                                <input type="time" required placeholder="HH:mm:ss" class="form-control" value="{{ old('duration', $edit_data['duration'] ?? '') }}" name="duration">
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="fullwidth" for="behName1">Location Search*:</label>
                                <input type="text" name="videolocationsearch" id="videolocationsearch" class="form-control" placeholder="Choose Location" value="{{ $edit_data['location'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Latitude :</label>
                                <input type="text" id="latitudevideo" name="latitudevideo" class="form-control" value="{{ $edit_data['latitude'] }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Longitude:</label>
                                <input type="text" name="longitudevideo" id="longitudevideo" class="form-control" value="{{ $edit_data['longitude'] }}" readonly>
                            </div>
                        </div>
                        <?php $get_tags = platformList();
                         $selected = json_decode($edit_data['platform']);
                        ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Platforms*:</label>
                                <select class="selectpicker"  multiple data-actions-box="true" required="" id="feild"name="platform[]" value="{{ old('platform') }}">
                                    @foreach ($get_tags as $key => $value)
                                        <option value="{{ $key }}" {{ (in_array($key, $selected)) ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="behName1">Keywords*:</label>
                                <input type="text" class="form-control tagsinput" value="{{ old('keywords', $edit_data['keywords'] ?? '') }}" name="keywords" required>
                            </div>
                        </div>
                        <?php $get_country = countryList();
                           ?>
       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-right-content form-group geo-blocking">
                                    <h3>Geo Blocking</h3>
                                    <label for="shortDescription3">Custom Select country</label>
                                    <select class="selectpicker form-control" name="country[]" multiple data-actions-box="true">
                                    <option value="" disabled>Select Country</option>   
                                    @foreach($get_country as $value)
                                    @if($edit_data['geo_blocking'] !='')
                                        <option value="{{ $value['country_id'] }}" {{ (in_array($value['country_id'], $edit_data['geo_blocking'])) ? 'selected' : '' }}>{{ $value['country_name']}}</option>
                                    @else                                                                 
                                    <option value="{{ $value['country_id'] }}" >{{ $value['country_name']}}</option>
                                    @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </section>
                    <h6>Route restrictions</h6>
                    <section>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="behName1">Language*:</label>
                                    <select class="form-control" required name="language" id="language">
                                        <option value="" disabled>Select Language</option>
                                        @foreach ($language as $key => $value)
                                        <option value="{{ $key }}" {{ $edit_data['language'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="behName1">Asset Type :</label>
                                    <input type="text" class="form-control" value="{{ old('asset_type', $edit_data['asset_type'] ?? '') }}" name="asset_type" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="behName1">Publish Date*:</label>
                                    <input type="date" class="form-control dtpicker publish_date" value="{{ $publishdate ?? '' }}" name="publish_date" required>
                                    <input type="time" class="form-control tmpicker publish_time" value="{{ $publishtime ?? '' }}" name="publish_time">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="behName1">Expiry Date*:</label>
                                    <input type="date" class="form-control dtpicker expiry_date" value="{{ $expiredate ?? '' }}" name="expiryDate" required>
                                    <input type="time" class="form-control tmpicker expiry_time" value="{{ $expiretime ?? '' }}" name="expiryTime">
                                    <div class="Expiryerror"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 25px;">
                                <div class="form-group">
                                    <label for="behName1">Status*:</label>
                                    <select class="form-control" required name="current_status" id="current_status">
                                        <option value="">Select value</option>
                                        @foreach ($status as $key => $value)
                                        <option value="{{ $key }}" {{ $edit_data['current_status'] == $key  ? 'selected' : ''}}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div id="collapsingsidebar" class="collapssidebar">
                        @include('releted_references.edit-content-reference');
                    </div>


                    <!-- Step 4 -->
                    <!--
                                <h6>Tags</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) {
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Search tag* :</label>
                                                    <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Alt Text for Image">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Frequents add</a></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Select tag :-  :</label>
                                                    <select name="cars" id="cars">
                                                        <option value="Photo Type">Photo Type</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <label for="wfirstName2"> Replace image*:</label> -->
                    <!-- <input type="text" class="form-control" value="There are no tags within this tag group." readonly  name="slug">
                                                </div>
                                            </div>
                                        </div>
                                </section>
                                <h6>Related &amp; content</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php //if(in_array($catalog_details['asset_type'], array('WATCH'))) {
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Search tag* :</label>
                                                    <input type="text" class="form-control" value="" name="alt_cover_image" placeholder="Alt Text for Image">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Select tag :-  :</label>
                                                    <select name="cars" id="cars">
                                                        <option value="Text">Text</option>
                                                        <option value="Photo">Photo</option>
                                                        <option value="Video">Video</option>
                                                        <option value="Document">Document</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Frequents add </a></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Recently Visited</a></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="wfirstName2"> <a href="#">Favourites</a></label>
                                            </div>
                                        </div>
                                </section>-->
                    </form>

                    <input class="save_content_draft btn btn-primary" type="button" style="float:right;" value="Draft" name="draft_btn"></button>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<div class="modal fade" id="Favourites_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60%; margin: 0 auto;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h2>Click the add button to attach the content reference</h2>
            <select class="form-control selectpicker" id="browsers" data-live-search="true" multiple data-actions-box="true" data-live-search="true" data-show-subtext="true">
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
                <option>
                    <h2>India’s squad for WTC Final and Test series against England announced</h2> <span class="lan">English | Last updated 31/08/2021</span> <span class='id'>ID:
                        154375</span>
                </option>
            </select>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="finish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <h3 class="modal-title" id="exampleModalLongTitle">Data has been save successfully</h5>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Submit</button> -->
                </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDetZZwXV4c_mQULaCiJLJvT8Z_XYhfQbI&libraries=places"></script>
<script src="{{ asset('js/playlists/playlists.js') }}" type="text/javascript"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

<script type="text/javascript">
    tinymce.init({
        selector: 'textarea.tinymce-editor',
        height: 500,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_css: '//www.tiny.cloud/css/codepen.min.css'
    });
</script>
<!-- summernote css/js -->
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script> -->

<script src="{{ asset('js/video/video.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/content_refernce/content_refernce.js') }}" type="text/javascript"></script>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify();

        $("#video_form button#collapsesidebar-btn").click(function() {
            $('#video_form #collapsingsidebar').toggleClass("collapse-deactive");
            $('#video_form section.body').toggleClass("collapse-deactive");
            $("#video_form button#collapsesidebar-btn").text(function(i, v) {
                return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
            });
        });
    });

    function editable_segment() {
        $('input[name="titleUrlSegment"]').removeAttr("readonly");
    }

    function save_url() {
        $('input[name="titleUrlSegment"]').attr("readonly", "readonly");
    }
</script>
<script>
    function copyFunction() {
        var pasteText = document.querySelector("#video_url");
        pasteText.focus();
        document.execCommand("paste");
        pasteText.value = pasteText.value + pasteText.value;
    }
</script>





@stop