<?php //echo "<pre>"; print_r($edit_data);exit;?>
@extends('base')
@section('epic_content')
<?php  $type = isset($_GET['type']) ? $_GET['type'] : ''; ?>
<?php error_reporting(E_ALL & ~E_NOTICE);?>
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
        <h4 class="page-title"></h4> </div>
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
<?php 
// pr($edit_data);die;

?>
@include('show_message')
<div class="modal-dialog modal-lg" style="width:100%">
        <div class="modal-content">
            <div class="modal-header upload" style="padding:5px 15px;">
                
                <h4 class="card-title head-title">Share Social Post</h4>
            </div>
     
        </div>
<form action="{{url('/SharePost')}}" method="POST" enctype="multipart/form-data" >
<div class="card-body wizard-content">
{{csrf_field()}}
<section>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="wfirstName2"> Title *</label>
                    <input type="text" class="form-control text-case"   name="title" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="wfirstName2"> Platform *</label>
                    <select class="form-control valid" name="platform[]" id="platform" required multiple>
                        <option value= selected disabled>Select Platform</option>
                        <option value="facebook">
                        Facebook</option>
                        <option value="instagram">
                        Instagram</option>
                        <option value="twitter">
                        Twitter</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="wfirstName2"> Media URL *</label>
                    <input type="file" class="form-control text-case" id="media_url" onchange="return fileValidation1()"  name="media_url[]" multiple>
                    <div id="Preview1"></div>
                  </div>
            </div>
        </div>
        <button> Submit </button>
</section>
</div>
</form>
</div>

<script>
  function fileValidation1(){
    var fileInput = document.getElementById('media_url');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.JPG|\.PNG)$/i;
    if(!allowedExtensions.exec(filePath)){
        $('#Preview1').html('<strong style="color:red">Please Select .JPG|.PNG type only.</strong>');
        fileInput.value = '';
        return false;
    }else{
        $('#Preview1').html('');
    }
}
</script>
@stop