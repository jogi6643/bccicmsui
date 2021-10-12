@extends('base') 
@section('title', 'Forgot Password')
@section('epic_content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
    <script type="text/javascript" src="{{asset('public/assets/js/parsley.js')}}"></script>
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/parsley.css')}}"> -->
    <style type="text/css">
    .fix-header #page-wrapper {
        margin-top: 0px;
        padding-bottom: 0px;
        min-height: 100vh!important;
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
    #page-wrapper{margin-left: 0px;}
    footer.footer.text-center{display: none;}
    </style>
    <section id="wrapper" class="new-login-register">
        <!-- <div class="lg-info-panel">
            <div class="inner-panel">      
                <div class="lg-content">
                    <h2>BCCI Admin Panel - 2021</h2>  
                </div>
            </div>
        </div> -->
        <div class="new-login-box">
            <div class="white-box">
                <h3 class="box-title m-b-0">Forgot Password</h3>
                <small>Enter your details below</small>
                <form class="form-horizontal new-lg-form forgot-password" id="forgot-password" method="post" data-parsley-validate="" action="{{ url('/setForgotPassword') }}" autocomplete="off">
                    {{ csrf_field() }}            
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label>Email Address</label>
                            <input class="form-control" type="email" placeholder="Email" name="email" required="" value="<?php echo Session::get('email'); ?>">
                        </div>
                    </div>
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
                    <div class="form-group">
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Continue</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>            
        </div>
    </section>
@endsection