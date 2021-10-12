<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('assets/images/epic-fv.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>BCCI Admin | @yield('title', '')</title>
    <link href="{{URL::asset('assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/style-bcci.css?v='.time())}}" rel="stylesheet">
    <link href="{{URL::asset('css/themify-icons.css?v='.time())}}" rel="stylesheet">
    <link href="{{URL::asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('plugins/bower_components/custom-select/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('plugins/bower_components/switchery/dist/switchery.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('plugins/bower_components/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('plugins/bower_components/nestable/nestable.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/colors/default.css')}}" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('plugins/bower_components/dropify/dist/css/dropify.min.css')}}">
    <link href="{{URL::asset('plugins/bower_components/jquery-wizard-master/steps.css')}}" rel="stylesheet">
    <link href="{{URL::asset('plugins/bower_components/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <!-- cropper js start  -->
    <!-- <link href="{{ URL::asset('dist/cropper.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" integrity="sha512-0SPWAwpC/17yYyZ/4HSllgaK7/gg9OlVozq8K7rf3J8LvCjYEEIfzzpnA2/SSjpGIunCSD18r3UhvDcu/xncWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="{{ URL::asset('dist/cropper.js') }}"></script> -->
    <!-- cropper js end -->
    <script src="{{URL::asset('assets/js/jwplayer.js')}}"></script>
    <script>
        jwplayer.key = "KjZLp2bXKLFcL2hCVYkFGYOMt5R/lLYPPlMUHJNj5VI3fqJ2";
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script type="text/javascript">
        var APP_URL = "{{ url('/')}}";
    </script>
</head>

<body class="fix-header">
    <div class="preloader">
        <p class="please-wait">Please wait....</p>
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="wrapper">
        @include('header')
        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('epic_content')
            </div>
            <footer class="footer text-center"> {{date("Y")}} &copy;blocked_countries </footer>
        </div>
    </div>
    @include('footer')
</body>

</html>