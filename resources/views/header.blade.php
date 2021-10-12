@section('header')
<style type="text/css">
.sidebar .arrow { top: 30px; }
.redlincle {
  text-decoration: underline;
  -webkit-text-decoration-color: red; /* Safari */
  text-decoration-color: red;
}
</style>
</style>
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="#">
                <!-- Logo icon image, you can use font-icon also --><b>
                    <!--This is dark logo icon--><img src="{{URL::asset('assets/images/bcci2.jpeg')}}" alt="home" class="dark-logo" />
                    <!--This is light logo icon--><img src="{{URL::asset('assets/images/bcci2.jpeg')}}" alt="home" class="light-logo" />
                </b>
                </span> </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>

            <!-- /.Megamenu -->
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">

            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <!--<i class="glyphicon glyphicon-user border-radius"></i>-->
                    <div class="round-img"><img src="{{URL::asset('assets/images/varun.jpg')}}"></div>
                    <b class="hidden-xs"></b>
                    <!-- <span class="caret"></span> --> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <!--<div class="u-img">
                               <i class="glyphicon glyphicon-user">
                                </i>
                               <img src="img/anurag-mishra.png" alt="user" />
                            </div>-->
                            <div class="u-text">
                                <h4>Welcome
                                    @if(isset(Session::get('user_data')['token']))
                                        {{Session::get('user_data')['name']}}
                                    @endif
                                </h4>
                                <p class="text-muted">admin</p>
                            </div>
                        </div>
                    </li>

                    <li><a href="{{url('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
<!-- End Top Navigation -->
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><!--<span class="fa-fw"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu"></span>-->
                <span class="ti-arrow-right arrow-menu"></span>

            </h3>
        </div>
        <ul class="nav" id="side-menu">
            <li class="selected"> <a href="{{url('/')}}" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard</span></a>
            <li class="devider"></li>
            </li>


            <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-bitbucket" data-icon="v"></i> <span class="hide-menu">Bucket<span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{url('addmenu')}}"><i class="mdi mdi-menu fa-fw"></i><span class="hide-menu">Menu</span></a> </li>
                </ul>
            </li>
            <li>
                <a href="{{url('uploadcontent')}}" class="waves-effect"><i class="mdi mdi-folder-upload fa-fw"></i> <span class="hide-menu">Upload Content
                <!-- not use <span class="fa arrow"> -->

                </span> </span>
            </a>

            </li>



            <li> <a href="{{url('/content')}}" class="waves-effect"><i class="mdi mdi-content-copy"></i><span class="hide-menu"> Content Management </span></a>
            </li>    
            <li>   
                <a href="{{url('/content')}}" class="waves-effect arrow-up"><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level content-curation">
                    <!-- not use <li> <a href="{{url('navigation')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu">Articles</span></a> </li> -->
                    {{-- <li> <a href="{{url('/contentList/articles')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu">Articles</span></a> </li> --}}
                    <li> <a href="{{url('/articles')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu">Articles</span></a> </li>
                    {{-- <!-- not use <li> <a href="{{url('gallary')}}"><i class="mdi mdi-vector-square fa-fw"></i><span class="hide-menu">Photos</span></a> </li> --> --}}
                    <!-- <li> <a href="{{url('/photos')}}"><i class="mdi mdi-vector-square fa-fw"></i><span class="hide-menu">Photos</span></a> </li> -->
                    <!-- <li> <a href="{{url('/contentList/images')}}"><i class="mdi mdi-vector-square fa-fw"></i><span class="hide-menu">Photos</span></a> </li> -->
                    <li> <a href="{{url('/photos')}}"><i class="mdi mdi-vector-square fa-fw"></i><span class="hide-menu">Photos</span></a> </li>
                    <!-- <li> <a href="{{url('/contentList/playlists')}}"><i class="mdi mdi-playlist-play"></i><span class="hide-menu"><span class="">Playlists</span></span></a> </li> -->
                    <li> <a href="{{url('/playlists')}}"><i class="mdi mdi-playlist-play"></i><span class="hide-menu"><span class="">Playlists</span></span></a> </li>

                    <li> <a href="{{url('/getVideoList')}}"><i class="mdi mdi-playlist-play"></i><span class="hide-menu">Videos</span></a> </li>

                    <li> <a href="{{url('/getAudioList')}}"><i class="mdi mdi-playlist-play"></i><span class="hide-menu">
                    Audio</span></a> </li>

              <!-- not use <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-video"></i><span class="hide-menu"> Videos <span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="{{url('livematch')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu">Live Match</span></a> </li>
                        <li> <a href="{{url('vodmatch')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu">VOD Match</span></a> </li>
                    </ul>

                </li> -->

                    <li> <a href="{{ url('/contentList/promo')}}">
                    <!-- not use <i class="mdi mdi-tag-faces fa-fw"></i> -->
                    <i class="mdi mdi-tag"></i>
                       <span class="hide-menu"> Promos</span> </a> </li>
                    <li> <a href="{{url('getdocument')}}"><i class="mdi mdi-tag-faces fa-fw"></i><span class="hide-menu">Documents</span></a> </li>
                    <li> <a href="{{url('bios')}}"><i class="mdi mdi-tag-faces fa-fw"></i><span class="hide-menu">Bios</span></a> </li>
                    <li> <a href="{{url('/logo')}}" ><i class="fas mdi mdi-hand-pointing-right" data-icon="v"></i> <span class="hide-menu"><span class="redlincle"> Logo Management</span>
                        <!-- <span not use class="fa arrow"></span> -->
                    <!-- </span></a> --></a>
                    <li> <a href="{{url('/venue')}}" ><i class="fas mdi mdi-hand-pointing-right" data-icon="v"></i> <span class="hide-menu"> <span class="redlincle">Venue</span>
                        <!-- <span class="fa arrow"></span> -->
                    </span></a>
                    </li>
                </ul>
            </li>

            <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-multiple-plus" data-icon="v"></i> <span class="hide-menu">User Management<span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{url('/bcciuserlist')}}"><i class="mdi mdi-account fa-fw"></i><span class="hide-menu">User List</span></a> </li>
                    <li> <a href="{{url('/privilegeslist')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu">Assign Roles</span></a> </li>
                </ul>
            </li>

          <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-monitor fa-fw" data-icon="v"></i> <span class="hide-menu"> <span class="redlincle">Content curation </span><span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{url('livematch')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu"><span class="redlincle">Livestreaming</span></span></a> </li>
                    <li> <a href="{{url('vodlivematch')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu"><span class="redlincle">VOD Content</span></span></a> </li>
                </ul>
            </li>

            <!-- <li> <a href="version1" class="waves-effect"><i class="mdi mdi-folder-upload fa-fw"></i> <span class="hide-menu"><span class="redlincle">Tray Management</span> -->
                <!--  no change <span class="fa arrow"> -->
<!-- 
                </span> </span></a>

            </li> -->

            <!-- <li> <a href="traysorting1" class="waves-effect"><i class="mdi mdi-account-card-details fa-fw"></i> <span class="hide-menu"><span class="redlincle">Tray Sorting </span></a> -->
                <!-- no change <span class="fa arrow"> -->
                <!-- </span> </span></a> -->

             <!-- </li> -->

            <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-account-settings-variant fa-fw" data-icon="v"></i> <span class="hide-menu"> <span class="redlincle">Page Curation </span><span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{ url('tray-management') }}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu"><span class="redlincle">Tray Management</span></span></a> </li>
                    <li> <a href="{{ url('tray-sorting') }}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu"><span class="redlincle"> Tray Sorting</span></span></a> </li>
                </ul>
            </li>

            <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-sort fa-fw" data-icon="v"></i> <span class="hide-menu"> <span class="redlincle">Tray Sorting </span><span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{url('traysorting1')}}"><i class="mdi mdi-book-open-page-variant fa-fw"></i><span class="hide-menu"><span class="redlincle">Version1</span></span></a> </li>

                </ul>
            </li> -->


            <li> <a href="othermenucontent" class="waves-effect"><i class="mdi mdi-checkerboard" data-icon="v"></i> <span class="hide-menu"> Other Menu Item <!-- <span class="fa arrow"></span> --> </span></a>
                <!-- <ul class="nav nav-second-level">
                    <li> <a href="{{url('/liveblogs')}}"><i class="fas mdi mdi-hand-pointing-right"></i><span class="hide-menu">Live Blogs</span></a> </li>
                    <li> <a href="{{url('#')}}"><i class="fas mdi mdi-hand-pointing-right"></i><span class="hide-menu">Blog Icons</span></a> </li>
                </ul> -->
            </li>

            <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-blogger" data-icon="v"></i> <span class="hide-menu"> Blogging <span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{url('/liveblogs')}}"><i class="fas mdi mdi-hand-pointing-right"></i><span class="hide-menu">Live Blogs</span></a> </li>
                    <li> <a href="{{url('#')}}"><i class="fas mdi mdi-hand-pointing-right"></i><span class="hide-menu">Blog Icons</span></a> </li>
                </ul>
            </li> -->
             <!-- <li> <a href="{{url('/logo')}}" class="waves-effect"><i class="mdi" data-icon="v"></i> <span class="hide-menu"> LOGO Management <span class="fa arrow"></span> </span></a>

            </li>  -->
            <!-- <li> <a href="{{url('/gallary')}}" class="waves-effect"><i class="mdi" data-icon="v"></i> <span class="hide-menu"> Photo Gallery <span class="fa arrow"></span> </span></a>

            </li> -->
            <!-- <li> <a href="{{url('/venue')}}" class="waves-effect"><i class="mdi" data-icon="v"></i> <span class="hide-menu"> Venue <span class="fa arrow"></span> </span></a>

            </li> -->
        </ul>
    </div>
</div>
@show
