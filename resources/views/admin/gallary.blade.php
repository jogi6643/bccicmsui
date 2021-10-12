@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
    });
</script>
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
    <div class="col-md-5">
        <div class="white-box">
            <!-- <h3 class="box-title m-b-0">Internal EPIC ON Display Ads</h3> -->
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-3 control-label">Select Genre</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="Genre" id="Genre">
                            <option value="">Select</option>
                            <option value="odi">ODI</option>
                            <option value="test">Test</option>
                            <option value="t20">T20s</option>
                            <option value="other">Others</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="redirection-url" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input name="title" id="title" value="" type="">
                    </div>
                </div>
                <div class="col-md-6 menu-icon-box">
                    <div class="form-group">
                        <label>Upload Folder</label>
                        <input type="file" class="dropify" data-default-file="" id="tag-menu-icon" name="menu_icon" required />
                        <!-- <span class="help-block"><small>Menu Icon for normal status</small></span> -->
                    </div>
                </div>
                <div class="col-md-6 menu-icon-box">
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" class="dropify" data-default-file="" id="tag-menu-icon-active" name="menu_icon_active" required />
                        <!-- <span class="help-block"><small>Menu Icon for active status</small></span> -->
                    </div>
                </div>
               
                <p><center>Accepts only jpg.,png.</center></p>
                <div class="form-group">
                   <label for="jobTitle2">Select Date:</label>
                   <input type="text" class="form-control mydatepicker" value="{{isset($content_view['release_date'])?$content_view['release_date']:''}}" name="date">
                </div>
                <div class="form-group">
                <label class="col-sm-4 control-label">Select Platform:</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">BCCI Domestic</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="bccid" id="tag-bccid" value="1" class="js-switch" data-color="#f96262" data-size="small" />                   
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">BCCI International</label>
                    <div class="col-sm-6">
                    <input type="checkbox" name="bccii" id="tag-bccii" value="1" class="js-switch" data-color="#f96262" data-size="small" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">IPL</label>
                    <div class="col-sm-6 ">
                    <input type="checkbox" name="ipl" id="tag-ipl" value="1" class="js-switch" data-color="#f96262" data-size="small" />
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="hidden" name="type" id="tag-type" value="">
                        <button type="submit" name="submit" id="submit" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

  
   
    <div class="col-sm-7">
        <div class="white-box">
            <h3 class="box-title"></h3>
            <div class="table-responsive">
                <table class="table color-bordered-table muted-bordered-table">
                    <thead>
                        <tr>
                            
                            <th>Sr. No</th>
                            <th>Title</th>
                            <th>Property</th>
                            <th>No of Images</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</div>


@stop