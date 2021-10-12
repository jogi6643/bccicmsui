@extends('base')
@section('title', 'View User')
@section('epic_content')

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li class="active"><a href="{{url('/bcciuserlist')}}">User List</a></li>
            <li class="active">View User</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>

<div class="row">
    <div class="col-md-12" style="margin-top:2%;">
        <div class="panel panel-info">
            <div class="panel-heading">
                <p class="box-title">View User</p>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">                        
                    <div class="form-body">
                        <h2 style="text-align: center">Detail Of User {{ucwords($userlist->user_first_name)}} {{ucwords($userlist->user_last_name)}}</h2>
                        @if($userlist->user_photo_url)
                            <img src="{{$userlist->user_photo_url}}" class="img-profile">
                        @endif
                        <hr>
                        <form method="post" action="">       
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">First Name <span class="appos">*</span></label>
                                        <input placeholder="User Name" class="form-control" value="{{$userlist->user_first_name}}" name="user_login" typr="text" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Name <span class="appos">*</span></label>
                                        <input placeholder="Display Name" class="form-control" type="text"
                                        value="{{$userlist->user_last_name}}" name="display_name" required="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Display Name <span class="appos">*</span></label>
                                        <input placeholder="Display Name" class="form-control" type="text"
                                        value="{{$userlist->user_title}} {{$userlist->user_first_name}} {{$userlist->user_last_name}}" name="display_name" required="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">User Email <span class="appos">*</span></label>
                                        <input placeholder="User Email" name="user_email" type="email"
                                        value="{{$userlist->user_email_id}}" required="" class="form-control" readonly></div>
                                </div>
                            </div>
                           
                            <div class="row">  
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">DOB<span class="appos">*</span></label>
                                        <input placeholder="User Name" class="form-control" value="{{$userlist->user_dob}}" name="user_login" typr="text" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Contact No <span class="appos">*</span></label>
                                        <input placeholder="Contact No" name="user_contact" type="text" required=""
                                        value="{{$userlist->user_phone_number}}" class="form-control" readonly></div>
                                </div> 
                            </div>
                            <div class="row">     
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Password <span class="appos">*</span></label>
                                        <input placeholder="Password" name="user_pass" type="text" value="{{$userlist->user_password}}"class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Status <span class="appos">*</span></label>
                                        <select name="user_role" class="form-control" disabled="true">
                                            <option value="1" {{ $userlist->user_status == 1 ? 'selected':'' }}>Active</option>
                                            <option value="0" {{ $userlist->user_status == 0 ? 'selected':'' }}>Inactive</option>
                                        </select>
                                     </div>
                                </div>
                            </div>
                                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-right-content">
                                        <label for="shortDescription3">Country <span class="appos">*</span></label>
                                            <select class="selectpicker" name="country" data-actions-box="true" value="{{old('country')}}" disabled="">
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
                                        <textarea class="form-control" name="location" value="123 Main Street, New York, NY 10030" rows="2" disabled>{{$userlist->user_address}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Assign Role <span class="appos">*</span></label>
                                        <select name="user_role" class="form-control" disabled="true">
                                                <option value="1" {{ $userlist->user_role_id == 1 ? 'selected':'' }}>Admin</option>
                                                <option value="2" {{ $userlist->user_role_id == 2 ? 'selected':'' }}>Editor</option>
                                                <option value="3" {{ $userlist->user_role_id == 3 ? 'selected':'' }}>Author</option>
                                                <option value="4" {{ $userlist->user_role_id == 4 ? 'selected':'' }}>Contributor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="control-label">Image</label>
                                    <br>
                                        @if($userlist->user_photo_url)
                                        <img class="img-thumbnail" src="{{ $userlist->user_photo_url}}">
                                        @else
                                        No image uploaded
                                        @endif
                                   </div> 
                                </div>
                                
                            </div>
                        </form>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                </div>
@stop