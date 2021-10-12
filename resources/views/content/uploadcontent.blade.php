@extends('base')
@section('epic_content')
<?php $type = Request::segment(2); ?>
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

    .form_name {
        text-transform: capitalize;
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
            <li class="active"><a href="{{url('uploadcontent')}}">Upload Content</a></li>
            <!-- <li class="active"></li> -->
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>


<div class="modal-dialog modal-lg" style="width:100%">
    <div class="modal-content">
        <div class="modal-header upload" style="padding:5px 15px;">

            <h4 class="card-title head-title uploadcont">Add New Asset <span class="form_name"></span></h4>
        </div>
        <div class="modal-body upload-body">
            @include('show_message')
            <div class="row">
                <div class="col-12">
                    <div class="col-md-12 white-box">
                    <div class="card-body wizard-content">
                    
                    <h6 class="card-subtitle uploadcont">Complete all the steps to add new asset</h6>
                    <label class="control-label uplcont">Asset Type*</label>
                        <div class="uploadcontent-select">
                            <select class="form-control" name="asset_type" id="asset_type" onchange="assettype()" >
                                <option value="">Select</option>
                                <option value="articles" <?php if($type == "articles"){ echo "selected";}?>>Articles</option>
                                <option value="photos"  <?php if($type == "photos"){ echo "selected";}?>>Photos</option>
                                <option value="playlists" <?php if($type == "playlists"){ echo "selected";}?>>Playlists</option>
                                <option value="videos" <?php if($type == "videos"){ echo "selected";}?>>Videos</option>
                                <option value="audio" <?php if($type == "audio"){ echo "selected";}?>>Audio</option>
                                <option value="promos" <?php if($type == "promos"){ echo "selected";}?>>Promos</option>
                                <option value="documents" <?php if($type == "documents"){ echo "selected";}?>>Documents</option>
                                <option value="bios" <?php if($type == "bios"){ echo "selected";}?>>Bios</option>
                            </select>
                        </div>
                        <!--  -->
                        <!-- 

                        @foreach($data  as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach -->
                            <div id="articles" style="display: none;">
                                @include('content.articles')
                            </div>
                            <div id="playlists" style="display: none;">
                                @include('content.playlists')
                            </div>
                            <div id="videos" style="display: none;">
                                @include('content.add-video')
                            </div>
                            <div id="audio" style="display: none;">
                                @include('content.audio')
                            </div>
                            <div id="promos" style="display: none;">
                                @include('content.promos')
                            </div>
                            <div id="documents" style="display: none;">
                                @include('content.documents')
                            </div>
                            <div id="bios" style="display: none;">
                                @include('content.bios')
                            </div>
                            <div id="photos" style="display: none;">
                                @include('content.photos')
                            </div>
                            <input class="save_content_draft btn btn-primary" type="button" style="float:right;" value="Draft" name="draft_btn">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


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
<script>
    $(document).ready(function() {
        assettype();
    });

    function assettype() {
        var type = '<?php //echo Request::segment(2); ?>';
        var asset = $("#asset_type").val();
        var asset_type = (asset) ? asset : type;
        $("#asset_type").val(asset_type);
        $('.form_name').html(asset_type);
        if (asset_type == 'photos') {
            document.getElementById("photos").style.display = "block";
            document.getElementById("articles").style.display = "none";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("videos").style.display = "none";
            document.getElementById("audio").style.display = "none";
            document.getElementById("promos").style.display = "none";
            document.getElementById("documents").style.display = "none";
            document.getElementById("bios").style.display = "none";
        } else if (asset_type == 'articles') {
            document.getElementById("articles").style.display = "block";
            document.getElementById("photos").style.display = "none";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("videos").style.display = "none";
            document.getElementById("audio").style.display = "none";
            document.getElementById("promos").style.display = "none";
            document.getElementById("documents").style.display = "none";
            document.getElementById("bios").style.display = "none";
        } else if (asset_type == 'playlists') {
            document.getElementById("playlists").style.display = "block";
            document.getElementById("articles").style.display = "none";
            document.getElementById("photos").style.display = "none";
            document.getElementById("videos").style.display = "none";
            document.getElementById("audio").style.display = "none";
            document.getElementById("promos").style.display = "none";
            document.getElementById("documents").style.display = "none";
            document.getElementById("bios").style.display = "none";
        } else if (asset_type == 'videos') {
            document.getElementById("videos").style.display = "block";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("articles").style.display = "none";
            document.getElementById("photos").style.display = "none";
            document.getElementById("audio").style.display = "none";
            document.getElementById("promos").style.display = "none";
            document.getElementById("documents").style.display = "none";
            document.getElementById("bios").style.display = "none";
        } else if (asset_type == 'audio') {
            document.getElementById("audio").style.display = "block";
            document.getElementById("videos").style.display = "none";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("articles").style.display = "none";
            document.getElementById("photos").style.display = "none";
            document.getElementById("promos").style.display = "none";
            document.getElementById("documents").style.display = "none";
            document.getElementById("bios").style.display = "none";
        } else if (asset_type == 'promos') {
            document.getElementById("promos").style.display = "block";
            document.getElementById("audio").style.display = "none";
            document.getElementById("videos").style.display = "none";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("articles").style.display = "none";
            document.getElementById("photos").style.display = "none";
            document.getElementById("documents").style.display = "none";
            document.getElementById("bios").style.display = "none";
        } else if (asset_type == 'documents') {
            document.getElementById("documents").style.display = "block";
            document.getElementById("promos").style.display = "none";
            document.getElementById("audio").style.display = "none";
            document.getElementById("videos").style.display = "none";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("articles").style.display = "none";
            document.getElementById("photos").style.display = "none";
            document.getElementById("bios").style.display = "none";
        } else if (asset_type == 'promos') {
            document.getElementById("promos").style.display = "block";
            document.getElementById("audio").style.display = "none";
            document.getElementById("videos").style.display = "none";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("articles").style.display = "none";
            document.getElementById("photos").style.display = "none";
            document.getElementById("documents").style.display = "none";
            document.getElementById("bios").style.display = "none";
        } else if (asset_type == 'bios') {
            document.getElementById("bios").style.display = "block";
            document.getElementById("promos").style.display = "none";
            document.getElementById("audio").style.display = "none";
            document.getElementById("videos").style.display = "none";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("articles").style.display = "none";
            document.getElementById("photos").style.display = "none";
            document.getElementById("documents").style.display = "none";
        } else {
            document.getElementById("articles").style.display = "none";
            document.getElementById("photos").style.display = "none";
            document.getElementById("playlists").style.display = "none";
            document.getElementById("videos").style.display = "none";
            document.getElementById("audio").style.display = "none";
            document.getElementById("promos").style.display = "none";
            document.getElementById("documents").style.display = "none";
            document.getElementById("bios").style.display = "none";
        }


        // alert(e);
    }
</script>



<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->

<!-- <script type="text/javascript">
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
    </script> -->
<!-- summernote css/js -->
<!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script> -->
@stop