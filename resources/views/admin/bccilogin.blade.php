@extends('base') 
@section('title', 'Login')
@section('epic_content')
<?php 
// echo $_SERVER['HTTP_REFERER'];
// exit;
?>
    <!-- Get HTML from Epic dashboard.blade.php -->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/parsley.css')}}">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    </style>
    <section id="wrapper" class="new-login-register">
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">Sign In to BCCI<sup>©</sup> Admin</h3>
                <small>Enter your details below</small>

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

                <form data-parsley-validate class="form-horizontal new-lg-form" method="POST" id="loginform" action="{{url('login_check')}}">
                    {{csrf_field()}}
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label>Email Address </label>
                            <input class="form-control" type="email" required placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Password</label>
                            <input class="form-control" type="password" required placeholder="Password"
                                   name="password">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button
                                    class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light"
                                    type="submit">Log In
                                </button>
                            </div>
                            <a href="{{url('/forgotpassword')}}" class="frg-pwd">Forgot Password</a>
                        </div>


                    </div>
                </form>
            </div>


        </div>
    </section>
<!-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>      -->
<script>
    $(document).ready(function() {
        if (performance.navigation.type == 2) {
            var referrer =  document.referrer;
            window.location.href = referrer;
            // alert(referrer);        
        }
    });
</script>

<!-- <script>
    alert("asdfsadf");
    return false;
    $(document).ready(function() {
    // console.log("ready!ready!ready!ready!ready!ready!ready!ready!ready!");
    var referrer =  document.referrer;
    let url = $(location).attr('href');
    let urlKey = referrer.replace(/\/\s*$/, "").split('/').pop();
    if(urlKey == 'dashboard'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }else if(urlKey == 'addmenu'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }else if(urlKey == 'uploadcontent'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'articleslist'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'photos'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'playlists'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'getVideoList'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'photos'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'promo'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'document'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'bios'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'logo'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'venue'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'bcciuserlist'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'privilegeslist'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'livematch'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'vodlivematch'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'version1'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'traysorting1'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
    else if(urlKey == 'othermenucontent'){
        console.log("urlKey 1212121212121212", urlKey);
        window.location.href = "http://dev.bccicms.epicon.in/dashboard";
        // setTimeout(function() {
        //     location.reload();
        // }, 5000);
    }
});
</script>     -->
@stop
