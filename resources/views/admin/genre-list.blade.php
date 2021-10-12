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
    <div class="col-md-4">
        <div class="white-box">
            <!-- <h3 class="box-title m-b-0">Internal EPIC ON Display Ads</h3> -->
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="redirection-url" class="col-sm-3 control-label">Name*</label>
                    <div class="col-sm-9">
                        <input name="name" id="name" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="redirection-url" class="col-sm-3 control-label">Slug</label>
                    <div class="col-sm-9">
                        <input name="slug" id="slug" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Display Type</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="display_type" id="display_type">
                            <option>STANDARD</option>
                            <option>SPECIAL</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Order</label>
                    <div class="col-sm-9">
                        <input name="order" id="order" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                        <label>Genre Image *</label>
                        <input type="file" class="dropify" data-default-file="" id="genre_image" name="genre_image" required />
                        <span class="help-block"><small>Genre Image</small></span>
                    </div>
                    <div class="form-group">
                        <label>Genre Thumbnail Image *</label>
                        <input type="file" class="dropify" data-default-file="" id="genre_thumb_image" name="genre_thumb_image" required />
                        <span class="help-block"><small>Genre Thumbnail Image</small></span>
                    </div>
               
               
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-6 control-label">Show in Menu</label>
                    <div class="col-sm-2">
                        <input type="checkbox" name="show_in_menu" id="tag-show_in_menu" value="1" class="js-switch" data-color="#f96262" data-size="small" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="control-label">Menu Version</label>
                    <div class="">
                        <select class="form-control" name="menu_version" id="menu_version">
                            <option value="1">version 1</option>
                            <option value="2">version 2</option>
                        </select>
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
  
   
    <div class="col-sm-8">
        <div class="white-box">
            <h3 class="box-title"></h3>
            <div class="table-responsive">
                <table class="table color-bordered-table muted-bordered-table">
                    <thead>
                        <tr>
                            
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Display Type</th>
                            <th>Order</th>
                            <th>Genre Image</th>
                            <th>Genre Thumbnail Image</th>
                            <th>Show In Menu</th>
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