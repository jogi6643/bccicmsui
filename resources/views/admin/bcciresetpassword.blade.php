@extends('base')
@section('title', 'Reset Password')
@section('epic_content')
<!-- Get HTML from Epic dashboard.blade.php -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script type="text/javascript" src="{{asset('public/assets/js/parsley.js')}}"></script>
<style type="text/css">
    .fix-header #page-wrapper {
        margin-top: 0px;
        padding-bottom: 0px;
        min-height: 100vh !important;
    }

    nav.navbar.navbar-default.navbar-static-top.m-b-0 {
        display: none;
    }

    .navbar-default.sidebar {
        display: none;
    }

    .container-fluid {
        padding-left: 0px;
    }

    #page-wrapper {
        margin-left: 0px;
    }

    footer.footer.text-center {
        display: none;
    }

    .new-login-register {
        overflow-y: scroll;
    }
</style>
<section id="wrapper" class="new-login-register">
    <div class="new-login-box forgot-password">
        <div class="white-box">
            <h3 class="box-title m-b-0">Reset Password</h3>
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block alertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if($message = Session::get('error'))
            <div class="alert alert-danger alert-block alertMessage">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <form class="form-horizontal new-lg-form" data-parsley-validate="" method="POST" id="loginform" action="{{ route('resetpasswordpost') }}">
                {{ csrf_field() }}
                <div class="form-group  m-t-20">
                    <div class="col-xs-12">
                        <label>Email Address</label>
                        <input class="form-control" type="email" placeholder="Email" name="email" value="{{$user_email}}" readonly="">
                        @if ($errors->has('email'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('email') }}.</strong>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Password</label>
                        <input class="form-control" type="password" required placeholder="Password" id="password" name="password">
                        <div id="password_error" style="color:red; display: none;"></div>
                        @if ($errors->has('password'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('password') }}.</strong>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label> Confirm Password</label>
                        <input class="form-control" type="password" required="" placeholder="Confirm Password" id="confirmpassword" name="confirm-password" value="{{ old('confirm-password') }}">
                        <div id="confirmpassworderror" style="color:red; display: none;"></div>
                        @if ($errors->has('confirm-password'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('confirm-password') }}.</strong>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label> OTP</label>
                        <input class="form-control" type="text" required="" placeholder="OTP" name="otp" value="{{ old('otp') }}" data-parsley-type="digits">
                        @if ($errors->has('otp'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('otp') }}.</strong>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- <div class="form-group">
                        @if(Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get("error") }}</div>
                        @endif
                    </div> -->
                <div class="form-group">
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit" onclick="return matchPassword()">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    function matchPassword() {

        var password = document.getElementById("password").value;
        var confirmpassword = document.getElementById("confirmpassword").value;
        document.getElementById("password_error").style.display = "none";
        document.getElementById("confirmpassworderror").style.display = "none";
        if(password == ""){
            document.getElementById("password_error").style.display = "block";
            document.getElementById("password_error").innerText = "Password can not blank";
            // alert('Password can not blank');
            return false;
        }confirmpassworderror
        if(confirmpassword == ""){
            document.getElementById("confirmpassworderror").style.display = "block";
            document.getElementById("confirmpassworderror").innerText = "Confirm password can not blank";
            // alert('Confirm password can not blank');
            return false;
        }
        // if(password != '' && confirmpassword != ''){
            if(password != confirmpassword){
                document.getElementById("password_error").style.display = "block";
                document.getElementById("password_error").innerText = "Password and confirm password did not match";   
                // alert("Passwords did not match");  
                return false;
            }
        // }
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,64}$/;
        var txt = document.getElementById("password");
        if (!regex.test(txt.value)) {
            document.getElementById("password_error").style.display = "block";
            document.getElementById("password_error").innerText = "Min 8,Max 64,At Least One Uppercase Character,One Lowercase Character,One Numeric Value And One Special Character(!@#$%^&*) Required ";
            // alert("Min 8,Max 64,At Least One Uppercase Character,One Lowercase Character,One Numeric Value And One Special Character(!@#$%^&*) Required ");
            return false;
        }
        
    }
</script>
@endsection