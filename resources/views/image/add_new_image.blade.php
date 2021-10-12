@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<style type="text/css">
    button.btn.dropdown-toggle.bs-placeholder.btn-default {
        padding: 8px 11px;
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
                <li><a href="{{url('#')}}">User Management</a></li>
                <li class="active">Assign Role</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-top:2%;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <p class="box-title">Assign Role</p>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="form-body">
                            <hr>
                            <form method="POST" action="{{route('saveNewImage')}}" name="previleges_form" id="previleges_form" enctype="multipart/form-data"data-parsley-validate>
                                {{csrf_field()}}
                                <input type="file" name="image_file" id="image_file">
                                <button type="submit" name="submit" value="">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection