@extends('base')
@section('title', 'Add New User')
@section('epic_content')

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"><a href="{{url('bcciuserlist')}}">User list</a></li>
            <li class="active">Add New User</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>

<?php
    // dd($country);
?>

<div class="row">
    <div class="col-md-12" style="margin-top:2%;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <p class="box-title">Add New User</p>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block alertMessage">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block alertMessage">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="panel-body">
                    <div class="form-body">
                        <hr>
                        <form data-parsley-validate="" method="post" action="{{url('/savebccinewuser')}}" enctype="multipart/form-data" autocomplete="off">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label class="control-label">Title <span class="appos">*</span></label>
                                        <select name="user_title" class="form-control"  data-parsley-required="true"   data-parsley-required-message ="Please select title">
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Miss">Miss</option>
                                        </select>
                                        <p class="error">{{$errors->first('user_title')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">First Name <span class="appos">*</span></label>
                                        <input placeholder="First Name" class="form-control" name="user_login" type="text"  required data-parsley-required="true"  data-parsley-required-message ="Enter First Name" value="{{ old('user_login') }}">
                                        <p class="error">{{$errors->first('user_login')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Name <span class="appos">*</span></label>
                                        <input placeholder="Last Name" class="form-control" type="text" name="display_name"  required data-parsley-required="true"  data-parsley-required-message ="Enter Last Name" data-parsley-minlength="3" value="{{old('display_name')}}">
                                        <p class="error">{{$errors->first('display_name')}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">User Email <span class="appos">*</span></label>
                                        <input placeholder="User Email" name="user_email" type="email"  required data-parsley-required="true" class="form-control" data-parsley-type="email"  data-parsley-required-message ="Enter Email" value="{{old('user_email')}}">
                                        <p class="error">{{$errors->first('user_email')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Contact No <span class=    "appos">*</span></label>
                                        <input placeholder="Contact No" name="user_contact" required data-parsley-required="true" class="form-control" data-parsley-type="digits" data-parsley-maxlength="10"  data-parsley-required-message ="Enter Phone Number" value="{{old('user_contact')}}">
                                        <p class="error">{{$errors->first('user_contact')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Password <span class="appos">*</span></label>
                                        <input placeholder="Password" name="user_pass" type="password" class="form-control" id="user_pass" required data-parsley-required="true"  data-parsley-required-message ="Enter Password" data-parsley-minlength="8"  > 
                                            <span class="errorspannewpassinput"></span>
                                        <p class="error">{{$errors->first('user_pass')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Confirms Password <span class="appos">*</span></label>
                                        <input placeholder="Confirm Password" name="user_confirm_pass" type="password" id="user_confirm_pass" class="form-control" data-parsley-required="true"  data-parsley-required-message ="Enter Confirm Password" data-parsley-equalto="#user_pass"
                                        data-parsley-equalto-message ="Password and Confirm Password must be same">
                                        <p class="error">{{$errors->first('user_confirm_pass')}}</p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-right-content">
                                        <label for="shortDescription3">Country <span class="appos">*</span></label>
                                        <select class="selectpicker" name="country" data-actions-box="true" value="{{old('country')}}" required data-parsley-required="true" data-parsley-required-message ="Select Country">
                                            <option value="">Select Country</option>
                                            @foreach($country as $key => $value)
                                                <option value="{{$value['country_id']}}" @if (old('country') == '{{$value["country_id"]}}') selected="selected" @endif>{{$value['country_name']}}</option>
                                            @endforeach
                                        </select>
                                        <p class="error">{{$errors->first('country')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Location</label>
                                        <textarea class="form-control" name="location" rows="2" required data-parsley-required="true" >{{old('location')}}</textarea>
                                        <p class="error">{{$errors->first('location')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Assign Role <span class="appos">*</span></label>
                                        <select name="user_role" class="form-control" required data-parsley-required="true" data-parsley-required-message ="Please Assign Role">
                                            {{-- <option value="1" @if (old('user_role') == '1') selected="selected" @endif>Admin</option>
                                            <option value="2" @if (old('user_role') == '2') selected="selected" @endif>Editor</option>
                                            <option value="3" @if (old('user_role') == '3') selected="selected" @endif>Author</option>
                                            <option value="4" @if (old('user_role') == '4') selected="selected" @endif>Contributor</option> --}}
                                            <option value="">-- Select --</option>
                                                @foreach($privileges['data'] as $val)
                                                    <option value="{{$val['role_id']}}">{{$val['role_name']}}</option>
                                                @endforeach
                                        </select>
                                        <p class="error">{{$errors->first('user_role')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Status <span class="appos">*</span></label>
                                        <select name="user_status" class="form-control" required data-parsley-required="true" data-parsley-required-message="Select Status">
                                            <option value="1" @if (old('user_status') == '1') selected="selected" @endif>Active</option>
                                            <option value="0" @if (old('user_status') == '0') selected="selected" @endif>Inactive</option>
                                        </select>
                                        <p class="error">{{$errors->first('user_status')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Upload Photo</label>
                                    <input type="file" name="photo" class="form-control user_upload_photo" placeholder="" value="{{old('photo')}}" id="user_upload_photo" aria-invalid="false" data-parsley-max-file-size="300">
                                    <p class="error upload_size_error">{{$errors->first('photo')}}</p>
                                </div>
                            </div>
                            <div class="text-left button-box-wrap">
                                <button class="submit" type="submit">Submit</button>
                                <a href="{{url('bcciuserlist')}}"><button class="submit" type="button">Cancel</button></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

