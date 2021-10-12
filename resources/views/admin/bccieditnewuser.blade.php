@extends('base')
@section('title', 'Edit User')
@section('epic_content')

<?php
    // dd($userlist);
?>

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"><a href="{{url('/bcciaddnewuser')}}">New User</a></li>
            <li class="active">Edit User</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>

<div class="row">
    <div class="col-md-12" style="margin-top:2%;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <p class="box-title">Edit User</p>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                    <div class="form-body">
                        @if($userlist->user_photo_url)
                            <img src="{{$userlist->user_photo_url}}" class="img-profile">
                        @endif
                        <form method="post" data-parsley-validate="" action="{{url('/updatebccinewuser')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="user_update_status" id="user_update_status" class="user_update_status" value="{{$userlist->user_id}}">
                            <input type="hidden" name="user_title" id="user_title" class="user_title" value="{{$userlist->user_title}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">First Name <span class="appos">*</span></label>
                                        <input placeholder="User Name" class="form-control" name="first_name" value="{{$userlist->user_first_name}}"  type="text" required data-parsley-required="true"  data-parsley-required-message ="Enter First Name">
                                        <p class="error">{{$errors->first('first_name')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Name <span class="appos">*</span></label>
                                        <input placeholder="Display Name" class="form-control" type="text" name="last_name" value="{{$userlist->user_last_name}}"required data-parsley-required="true"  data-parsley-required-message ="Enter Last Name">
                                        <p class="error">{{$errors->first('last_name')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">User Email <span class="appos">*</span></label>
                                        <input placeholder="User Email" name="user_email" type="email" required data-parsley-required="true"  value="{{$userlist->user_email_id}}" class="form-control" data-parsley-required-message ="Enter Email" readonly>
                                        <p class="error">{{$errors->first('user_email')}}</p>
                                   </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Contact No <span class="appos">*</span></label>
                                        <input placeholder="Contact No" name="user_contact"  data-parsley-type="digits"  value="{{$userlist->user_phone_number}}" required data-parsley-required="true"class="form-control" data-parsley-minlength="10" data-parsley-maxlength="10"  data-parsley-required-message ="Enter Phone Number"  data-parsley-minlength-message="Must be a vaild Phone Number" data-parsley-maxlength-message="Must be a vaild Phone Number">
                                        <p class="error">{{$errors->first('user_contact')}}</p> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Password <span class="appos">*</span></label>
                                        <input placeholder="Password" name="user_pass" type="text"  value="{{$userlist->user_password}}" class="form-control" required data-parsley-required="true"  data-parsley-required-message ="Enter Password" data-parsley-minlength="8" data-parsley-minlength-message="Password length is too sort">
                                        <p class="error">{{$errors->first('user_pass')}}</p>
                                        <!-- data-parsley-pattern="(?=.*?[#?!@$%^&*-\]\[])" -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password <span class="appos">*</span></label>
                                        <input placeholder="Confirm Password" name="user_confirm_pass" type="text" value="{{$userlist->user_password}}" class="form-control" required data-parsley-required="true" data-parsley-required-message ="Enter Confirm Password" >
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
                                                <option value="{{$value['country_id']}}" {{ $value['country_id'] == $userlist->user_country_id ? 'selected':'' }}>{{$value['country_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Location</label>
                                        <textarea class="form-control" name="location" rows="2" >{{$userlist->user_address}}</textarea>
                                        <p class="error">{{$errors->first('location')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Assign Role <span class="appos">*</span></label>
                                        <select name="user_role" class="form-control"required data-parsley-required="true" data-parsley-required-message ="Please Assign Role">
                                            {{-- <option value="1" {{ $userlist->user_role_id == 1 ? 'selected':'' }}>Admin</option>
                                            <option value="2" {{ $userlist->user_role_id == 2 ? 'selected':'' }}>Editor</option>
                                            <option value="3" {{ $userlist->user_role_id == 3 ? 'selected':'' }}>Author</option>
                                            <option value="4" {{ $userlist->user_role_id == 4 ? 'selected':'' }}>Contributor</option> --}}
                                                @foreach($privileges['data'] as $val)
                                                    <option value="{{$val['role_id']}}" {{ $userlist->user_role_id == $val['role_id'] ? 'selected':'' }}>{{$val['role_name']}}</option>
                                                @endforeach
                                        </select>
                                        <p class="error">{{$errors->first('user_role')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Status <span class="appos">*</span></label>
                                        <select name="user_status" class="form-control" required data-parsley-required="true" data-parsley-required-message="Select Status">
                                            <option value="1" {{ $userlist->user_status == 1 ? 'selected':'' }}>Active</option>
                                            <option value="0" {{ $userlist->user_status == 0 ? 'selected':'' }}>Inactive</option>
                                        </select>
                                        <p class="error">{{$errors->first('user_status')}}</p>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Upload Photo</label>
                                    <input type="file" name="photo" class="form-control user_upload_photo" placeholder="" value=""  aria-invalid="false" id="user_upload_photo" data-parsley-max-file-size="300">
                                    <input type="hidden" name="user_old_photo" value="{{$userlist->user_photo_url}}">
                                    <p class="error upload_size_error">{{$errors->first('photo')}}</p>
                                </div>
                            </div>
                            <div class="text-left button-box-wrap">
                                <button class="submit" type="submit">Update</button>
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
