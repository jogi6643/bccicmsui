@extends('base')
@section('epic_content')
                <div class="row">
                    <div class="col-md-12" style="margin-top:2%;">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                                                    <p class="box-title">Add New User</p>
                                                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                        <div class="form-body">
                                            <hr>
                                    <form method="post" action="https://livecms.epicon.in/admin-user-action">
                                            <input type="hidden" name="_token" value="2WA1CO2xxeZh8a7rTty5FHr2LCHNHkTHCdFlCLAa">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">User Name</label>
                                                        <input class="form-control" name="user_login" typr="text"> <span class="help-block"> This Should be Unique.</span></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label>
                                                        <input name="user_pass" type="password" class="form-control"> <span class="help-block"> Password for the User </span> </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">User Email</label>
                                                        <input name="user_email" type="email" required="" class="form-control"> <span class="help-block"> Any of User's Active Email </span> </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">User Role</label>
                                                        <select name="user_role" class="form-control">
                                                            <option value="1">Admin</option>
                                                            <option value="2">Editor</option>
                                                            <option value="3">Author</option>
                                                            <option value="4">Contributor</option>
                                                        </select> <span class="help-block"> <i>User Level</i> </span> </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">User Status</label>
                                                        <input class="form-control" type="text" name="user_status" required=""> <span class="help-block"> This Should be Unique.</span></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Display Name</label>
                                                        <input class="form-control" type="text" name="display_name" required=""> <span class="help-block"> Name for Public Display </span> </div>
                                                </div>
                                            </div>
                                        <div class="form-actions">
                                            <input type="submit" value="add" name="action" class="btn btn-success">
                                        </div>
                                    </form>
                                                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                </div>
@stop