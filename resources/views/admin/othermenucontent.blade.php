@extends('base')
@section('epic_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("li.btn").click(function(){
        $("li.btn").removeClass("active");
        $(this).addClass("active");
});
        });
</script>


<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"></h4>
    </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <ol class="breadcrumb">
            <li><a href="{{url('#')}}"></a></li>
            <li class="active">Other Menu Item</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>

<!-- .row -->
<div class="container-fluid">
          <div class="row">
              
              <div class="card margin-top">
                   <!-- 3 columns -->
                        <h3>BCCI Menu Item</h3>
                        <div class="container">
                          <div class="row">
                            
                            <div class="col-xs-12 col-sm-4">
                             <a href="bccidomestic">   
                              <div class="box">
                                <h3>BCCI Domestic</h3>
                              </div>
                             </a> 
                            </div>
                            
                            <div class="col-xs-12 col-sm-4">
                             <a href="bcciinternational">   
                              <div class="box">
                                <h3>BCCI International</h3>
                              </div>
                             </a> 
                            </div>
                            
                            <div class="col-xs-12 col-sm-4">
                             <a href="ipl">    
                              <div class="box">
                                <h3>IPL</h3>
                              </div>
                             </a> 
                            </div>
                            <div class="col-xs-12 col-sm-4 col-sm-offset-2">
                             <a href="{{url('/logo')}}">    
                              <div class="box">
                                <h3>Logo Management</h3>
                              </div>
                             </a> 
                            </div>
                            <div class="col-xs-12 col-sm-4">
                             <a href="{{url('/termscondition')}}">    
                              <div class="box">
                                <h3>T & C</h3>
                              </div>
                             </a> 
                            </div>
                            
                          </div>
                        </div>


                 <!-- 3 columns -->

              </div>

          </div>
</div>


@stop